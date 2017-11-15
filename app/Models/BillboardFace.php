<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;

class BillboardFace extends Model
{

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
        'rate_card' => 'float',
        'max_ads' => 'int',
        'duration' => 'int',
        'team_id' => 'int',
        'is_illuminated' => 'boolean',
    ];

    protected $dates = [

    ];

    public function billboard()
    {
        return $this->belongsTo(Billboard::class);
    }

    #region

    #region Custom Attributes

    #endregion

    #region Queries

    #endregion

    #region Conversions
    public function toArray()
    {
        $data = [
            'id' => $this->id,
            'code' => $this->code,
            'slug' => $this->slug,
            'label' => $this->label,
            'facing' => $this->facing,
            'height' => $this->height,
            'width' => $this->width,
            'reads' => $this->reads,
            'rate_card' => $this->rate_card,
            'monthly_impressions' => $this->monthly_impressions,
            'notes' => $this->notes,
            'max_ads' => $this->max_ads,
            'duration' => $this->duration,
            'photo_url' => $this->photo_url,
            'is_illuminated' => $this->is_illuminated,
            'lights_on' => $this->lights_on,
            'lights_off' => $this->lights_off,
            'type' => $this->type,
            'billboard_id' => $this->billboard_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        return $data;
    }
    #endregion

}
