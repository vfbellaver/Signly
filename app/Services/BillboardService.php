<?php

namespace App\Services;

use App\Events\BillboardCreated;
use App\Events\BillboardDeleted;
use App\Events\BillboardUpdated;
use App\Forms\BillboardForm;
use App\Models\Billboard;

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
        return \DB::transaction(function() use ($billboard) {
           $billboard->delete();

           event(new BillboardDeleted($billboard));
        });
    }
}