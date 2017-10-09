<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billboard extends Model
{
    protected $fillable = [
		'name',
		'description',
		'address',
		'lat',
		'lng',
		'heading',
		'pitch',
		'zoom',
		'pano',
    ];

    protected $casts = [
    ];

    protected $dates = [
    ];

    #region Relationships
    #region

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
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
			'description' => $this->description,
			'digital_driveby' => $this->digital_driveby,
			'address' => $this->address,
			'lat' => $this->lat,
			'lng' => $this->lng,
            'heading' => $this->heading,
            'pitch' => $this->pitch,
            'zoom'=> $this->zoom,
            'pano' => $this->pano,
            'user' => $this->user->toArray(),
            'team' => $this->team->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
    #endregion

}
