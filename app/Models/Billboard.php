<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billboard extends Model
{
    protected $fillable = [
        'name',
        'slugname',
        'address',
        'lat',
        'lng',
        'heading',
        'pitch',
        'description',
        'user_id',
        'team_id'
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'heading' => 'float',
        'pitch' => 'float',
    ];

    protected $dates = [
    ];

    #region Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billboardFaces()
    {
        return $this->hasMany(BillboardFace::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
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
            'slugname'=> $this->slugname,
            'description' => $this->description,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'heading' => $this->heading,
            'pitch' => $this->pitch,
            'user' => $this->user->toArray(),
            'team' =>$this->team->toArray(),
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
    #endregion

}
