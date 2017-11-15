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
                'label' => $form->label(),
                'rate_card' => $form->rateCard(),
                'monthly_impressions' => $form->monthlyImpressions(),
                'notes' => $form->notes(),
                'max_ads' => $form->maxAds(),
                'duration' => $form->duration(),
                'photo_url' => $form->photoUrl(),
                'is_illuminated' => $form->isIlluminated(),
                'lights_on' => $form->lightsOn(),
                'lights_off' => $form->lightsOff(),
                'team_id' => auth()->user()->team_id,
                'slug' => str_slug($form->code()),
                'type' => $form->type(),
                'reads' => $form->reads(),
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
            $billboardFace->rate_card = $form->rateCard();
            $billboardFace->monthly_impressions = $form->monthlyImpressions();
            $billboardFace->notes = $form->notes();
            $billboardFace->max_ads = $form->maxAds();
            $billboardFace->duration = $form->duration();
            $billboardFace->photo_url = $form->photoUrl();
            $billboardFace->is_illuminated = $form->isIlluminated();
            $billboardFace->lights_on = $form->lightsOn();
            $billboardFace->lights_off = $form->lightsOff();
            $billboardFace->type = $form->type();
            $billboardFace->billboard()->associate($form->billboard());

            $billboardFace->save();

            event(new BillboardFaceUpdated($billboardFace));

            return $billboardFace;
        });
    }

    public function delete(BillboardFace $billboardFace)
    {
        return \DB::transaction(function () use ($billboardFace) {
            $billboardFace->delete();

            event(new BillboardFaceDeleted($billboardFace));
        });
    }
}