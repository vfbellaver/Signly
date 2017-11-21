<?php

namespace App\Models;

use App\Helper\DataViewer;
use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;

class BillboardFace extends Model
{
    use DataViewer;

    const TYPE_STATIC = 'Static';
    const TYPE_DIGITAL = 'Digital';

    const READS_LEFT = 'Left';
    const READS_RIGHT = 'Right';
    const READS_ACROSS = 'Across';

    const FACING_NORTH = 'North';
    const FACING_SOUTH = 'South';
    const FACING_EAST = 'East';
    const FACING_WEST = 'West';

    protected $fillable = [
        'code',
        'label',
        'facing',
        'rate_card',
        'monthly_impressions',
        'duration',
        'is_illuminated',
        'height',
        'width',
        'reads',
        'notes',
        'max_ads',
        'photo_url',
        'lights_on',
        'lights_off',
        'type',
        'billboard_id',
        'team_id',
        'slug',
    ];

    protected $casts = [
        'rate_card' => 'decimal',
        'monthly_impressions' => 'decimal',
        'max_ads' => 'int',
        'duration' => 'int',
        'team_id' => 'int',
        'is_illuminated' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            static::addGlobalScope(new TeamScope(auth()->user()->team));
        }
    }

    public function billboard()
    {
        return $this->belongsTo(Billboard::class);
    }


    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function toArray()
    {
        $billboard = $this->billboard;

        $lat = $billboard->lat;
        $lng = $billboard->lng;

        $base = "https://maps.googleapis.com/maps/api/staticmap";
        $center = "?center={$lat},{$lng}";
        $marker = "&markers=icon:http://signly.clevermage.com/images/pin.png|{$lat},{$lng}";
        $zoom = "&zoom=14";
        $size = "&size=600x400";

        $staticMap = "{$base}{$center}{$marker}{$zoom}{$size}";

        return [
            'id' => $this->id,
            'code' => $this->code,
            'label' => $this->label,
            'facing' => $this->facing,
            'rate_card' => $this->rate_card,
            'monthly_impressions' => $this->monthly_impressions,
            'duration' => $this->duration,
            'is_illuminated' => $this->is_illuminated,
            'height' => $this->height,
            'width' => $this->width,
            'reads' => $this->reads,
            'notes' => $this->notes,
            'max_ads' => $this->max_ads,
            'photo_url' => $this->photo_url,
            'lights_on' => $this->lights_on,
            'lights_off' => $this->lights_off,
            'type' => $this->type,
            'billboard_id' => $this->billboard_id,
            'team_id' => $this->team_id,
            'slug' => $this->slug,
            'billboard_name' => $billboard->name,
            'location' => $billboard->address,
            'position' => [
                'lat' => $billboard->lat,
                'lng' => $billboard->lng,
            ],
            'static_map' => $staticMap,
            'pivot' => $this->pivot,
            'public_url' => route('billboard.public-view', [
                'teamSlug' => $this->team->slug,
                'faceCode' => $this->slug,
            ])
        ];
    }

}
