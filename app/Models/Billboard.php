<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billboard extends Model
{
    protected $fillable = [
		'name',
		'address',
		'lat',
		'lng',
    ];

    protected $casts = [
    ];

    protected $dates = [
    ];

    #region Relationships
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
			'name' => $this->name,
			'address' => $this->address,
			'lat' => $this->lat,
			'lng' => $this->lng,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
    #endregion

}
