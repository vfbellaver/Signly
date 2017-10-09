<?php

namespace App\Services;

use App\Events\BillboardCreated;
use App\Events\BillboardDeleted;
use App\Events\BillboardFaceCreated;
use App\Events\BillboardUpdated;
use App\Forms\BillboardForm;
use App\Models\Billboard;
use App\Models\BillboardFace;
use Carbon\Carbon;

class BillboardService
{
    public function create(BillboardForm $form): Billboard
    {
        return \DB::transaction(function () use ($form) {
            $data = [
                'name' => $form->name(),
                'description' => $form->description(),
                'digital_driveby' => $form->digitalDriveby(),
                'address' => $form->address(),
                'lat' => $form->lat(),
                'lng' => $form->lng(),
            ];

            $billboard = new Billboard($data);

            $billboard->save();

            event(new BillboardCreated($billboard));
            return $billboard;
        });
    }

    public function update(BillboardForm $form, Billboard $billboard): Billboard
    {
        return \DB::transaction(function () use ($form, $billboard) {

            $billboard->name = $form->name();
            $billboard->description = $form->description();
            $billboard->digital_driveby = $form->digitalDriveby();
            $billboard->address = $form->address();
            $billboard->lat = $form->lat();
            $billboard->lng = $form->lng();

            $billboard->save();

            event(new BillboardUpdated($billboard));

            return $billboard;
        });
    }

    public function delete(Billboard $billboard)
    {
        return \DB::transaction(function () use ($billboard) {
            $billboard->delete();

            event(new BillboardDeleted($billboard));
        });
    }

    public function extractCsvFile($filename)
    {
        $data = csv_to_array($filename);
        $billboards = [];
        foreach ($data as $row) {
            $billboard = [
                'name' => null,
                'description' => null,
                'address' => null,
                'lat' => null,
                'lng' => null,
            ];
            $billboard = array_intersect_key($row, $billboard);
            $billboard['faces'] = [];

            $i = 1;
            $required = ['code', 'label', 'hard_cost', 'monthly_impressions', 'duration'];
            $optional = ['height', 'width', 'reads', 'notes', 'max_ads', 'lights_on', 'lights_off', 'billboard_id', 'photo', 'is_illuminated'];
            while (isset($row["face{$i}_code"])) {
                $face = [];
                $valid = true;
                foreach ($required as $r) {
                    if (!isset($row["face{$i}_{$r}"]) || !$row["face{$i}_{$r}"]) {
                        $valid = false;
                        break;
                    }
                    $face[$r] = $row["face{$i}_{$r}"];
                }
                if (!$valid) {
                    $i++;
                    continue;
                }
                foreach ($optional as $o) {
                    if (!isset($row["face{$i}_{$o}"]) || !$row["face{$i}_{$o}"]) {
                        continue;
                    }
                    if ($o === 'lights_on' || $o === 'lights_off') {
                        $time = $row["face{$i}_{$o}"];
                        $face[$o] = Carbon::createFromFormat('h:i A', $time)->format('H:i:s');
                        continue;
                    }
                    $face[$o] = $row["face{$i}_{$o}"];
                }
                $billboard['faces'][] = $face;
                $i++;
            }
            $billboards[] = $billboard;
        }
        unset($billboard, $data, $face, $filename, $i, $o, $optional, $r, $required, $row, $time, $valid);

        return $billboards;
    }

    public function import($data)
    {
        return \DB::transaction(function () use ($data) {

            $billboards = $data['billboards'];
            $savedBillboards = [];

            foreach ($billboards as $blb) {
                //create o billboard
                $billboard = new Billboard();
                $billboard->name = $blb['name'];
                $billboard->description = $blb['description'];
                $billboard->address = $blb['address'];
                $billboard->lat = $blb['lat'];
                $billboard->lng = $blb['lng'];
                $faces = $blb['faces'];

                $billboard->save();
                event(new BillboardCreated($billboard));

                //create as faces relations
                foreach ($faces as $face) {
                    $billboardFace = new BillboardFace($face);
                    $billboardFace->billboard()->associate($billboard);
                    $billboardFace->save();

                    event(new BillboardFaceCreated($billboardFace));

                }
            }

            return $savedBillboards;
        });
    }
}