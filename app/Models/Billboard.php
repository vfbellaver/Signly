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
        'description',
        'user_id',
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
            'user' => $this->user->toArray(),
            'billboard_faces' => $this->billboardFaces->toArray(),
        ];
    }
    #endregion

}
