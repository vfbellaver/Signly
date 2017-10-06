<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;

class BillboardFace extends Model
{
    protected $fillable = [
		'code',
		'height',
		'width',
		'reads',
		'label',
		'hard_cost',
		'monthly_impressions',
		'notes',
		'max_ads',
		'duration',
		'photo',
		'is_illuminated',
        'lights_on',
        'lights_off',
		'billboard_id',
    ];

    protected $casts = [
		'max_ads' => 'int',
		'duration' => 'int',
		'is_illuminated' => 'boolean',
    ];

    protected $dates = [
    ];
    /*
    #region Relationships
	public function unique()
	{
		return $this->belongsTo(Unique::class);
	}
    */
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
        return [
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
			'billboard_id' => $this->billboard_id,
			'billboard' => $this->billboard->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
    #endregion

}
