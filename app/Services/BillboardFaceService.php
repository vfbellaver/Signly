<?php

namespace App\Services;

use App\Events\BillboardFaceCreated;
use App\Events\BillboardFaceDeleted;
use App\Events\BillboardFaceUpdated;
use App\Forms\BillboardFaceForm;
use App\Models\BillboardFace;

class BillboardFaceService
{
    public function create(BillboardFaceForm $form): BillboardFace
    {
        return \DB::transaction(function () use ($form) {
            $data = [
				'code' => $form->code(),
				'height' => $form->height(),
				'width' => $form->width(),
				'reads' => $form->reads(),
				'label' => $form->label(),
				'hard_cost' => $form->hardCost(),
				'monthly_impressions' => $form->monthlyImpressions(),
				'notes' => $form->notes(),
				'max_ads' => $form->maxAds(),
				'duration' => $form->duration(),
				'photo' => $form->photo(),
				'is_iluminated' => $form->isIluminated(),
            ];

            $billboardFace = new BillboardFace($data);
			$billboardFace->billboard()->associate($form->billboard());

            $billboardFace->save();

            event(new BillboardFaceCreated($billboardFace));

            return $billboardFace;
        });
    }

    public function update(BillboardFaceForm $form, BillboardFace $billboardFace): BillboardFace
    {
        return \DB::transaction(function () use ($form, $billboardFace) {

            $billboardFace->code = $form->code();
			$billboardFace->height = $form->height();
			$billboardFace->width = $form->width();
			$billboardFace->reads = $form->reads();
			$billboardFace->label = $form->label();
			$billboardFace->hard_cost = $form->hardCost();
			$billboardFace->monthly_impressions = $form->monthlyImpressions();
			$billboardFace->notes = $form->notes();
			$billboardFace->max_ads = $form->maxAds();
			$billboardFace->duration = $form->duration();
			$billboardFace->photo = $form->photo();
			$billboardFace->is_iluminated = $form->isIluminated();
			$billboardFace->billboard()->associate($form->billboard());

            $billboardFace->save();

            event(new BillboardFaceUpdated($billboardFace));

            return $billboardFace;
        });
    }

    public function delete(BillboardFace $billboardFace)
    {
        return \DB::transaction(function() use ($billboardFace) {
           $billboardFace->delete();

           event(new BillboardFaceDeleted($billboardFace));
        });
    }
}