<?php

namespace App\Services;

use App\Events\BillboardFaceCreated;
use App\Events\BillboardFaceDeleted;
use App\Events\BillboardFaceUpdated;
use App\Forms\BillboardFaceForm;
use App\Models\Billboard;
use App\Models\BillboardFace;

class BillboardPublicService
{
    private $key;
    private $size;

    function __construct()
    {
        $this->key = env('GOOGLE_API_KEY');
        $this->size = '500x300';
    }

    public function createPOVUrl(Billboard $billboard)
    {
        $lat = $billboard->lat;
        $lng = $billboard->lng;
        $pitch = $billboard->pitch;
        $heading = $billboard->heading;

        $url = 'https://maps.googleapis.com/maps/api/streetview?size='.$this->size.'&location='.$lat.','.$lng.
        '&fov=90&heading='.$heading.'&pitch='.$pitch.'&key='.$this->key;

        return $url;
    }
}