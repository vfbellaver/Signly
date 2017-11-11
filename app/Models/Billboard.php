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
        'heading',
        'pitch',
        'team_id'
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'heading' => 'float',
        'pitch' => 'float',
        'team_id' => 'integer'
    ];

    protected $dates = [
    ];

    #region Relationships

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function billboardFaces()
    {
        return $this->hasMany(BillboardFace::class);
    }
    #endregion

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
            'heading' => $this->heading,
            'pitch' => $this->pitch,
            'team' => $this->team->toArray(),
            'billboard_faces' => $this->billboardFaces->toArray(),
            'position' => [
                'lat' => $this->lat,
                'lng' => $this->lng,
            ],
            'pov' => [
                'heading' => $this->heading ? $this->heading : 0,
                'pitch' => $this->pitch ? $this->pitch : 0,
            ]
        ];
    }

    public function toLightArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
    #endregion

}
