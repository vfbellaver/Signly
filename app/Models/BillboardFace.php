<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;

class BillboardFace extends Model
{

    const TYPE = ['static','digital'];
    const READS = ['Left','Right','Across'];

    protected $fillable = [
        'code',
        'label',
        'hard_cost',
        'monthly_impressions',
        'duration',
        'is_illuminated',
        'height',
        'width',
        'reads',
        'notes',
        'max_ads',
        'photo',
        'lights_on',
        'lights_off',
        'type',
        'billboard_id',
    ];

    protected $casts = [
        'max_ads' => 'int',
        'duration' => 'int',
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
            'height' => $this->height,
            'width' => $this->width,
            'reads' => $this->reads,
            'label' => $this->label,
            'hard_cost' => $this->hard_cost,
            'monthly_impressions' => $this->monthly_impressions,
            'notes' => $this->notes,
            'max_ads' => $this->max_ads,
            'duration' => $this->duration,
            'photo' => $this->photo,
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
