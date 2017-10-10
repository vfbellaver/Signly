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
                'address' => $form->address(),
                'lat' => $form->lat(),
                'lng' => $form->lng(),
                'heading' => $form->heading(),
                'pitch' => $form->pitch(),
            ];

            $billboard = new Billboard($data);
            $billboard->user()->associate($form->user());

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
            $billboard->address = $form->address();
            $billboard->lat = $form->lat();
            $billboard->lng = $form->lng();
            $billboard->heading = $form->heading();
            $billboard->pitch = $form->pitch();

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
                'heading' => null,
                'pitch' => null,

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
            $events = [];
            $billboards = $data['billboards'];
            $savedBillboards = [];

            foreach ($billboards as $blb) {
                //create o billboard
                $billboard = Billboard::query()->create([
                    'name' => $blb['name'],
                    'description' => $blb['description'],
                    'address' => $blb['address'],
                    'lat' => $blb['lat'],
                    'lng' => $blb['lng'],
                    'user_id' => $data['user_id'],
                ]);

                $events[] = new BillboardCreated($billboard);

                $savedBillboards[] = $billboard;
                $faces = $blb['faces'];

                //create as faces relations
                foreach ($faces as $face) {
                    $billboardFace = new BillboardFace($face);
                    $billboardFace->billboard()->associate($billboard);
                    $billboardFace->save();

                    $events[] = new BillboardFaceCreated($billboardFace);
                }
            }

            foreach ($events as $event) {
                event($event);
            }
            return $savedBillboards;
        });
    }
}