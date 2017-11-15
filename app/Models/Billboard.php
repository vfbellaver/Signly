<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Billboard extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'address',
        'lat',
        'lng',
        'heading',
        'pitch',
        'description',
        'team_id'
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'heading' => 'float',
        'pitch' => 'float',
        'team_id' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            static::addGlobalScope(new TeamScope(auth()->user()->team));
        }
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function billboardFaces()
    {
        return $this->hasMany(BillboardFace::class);
    }
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'team' => $this->team,
            'billboard_faces' => $this->billboardFaces,
            'position' => [
                'lat' => $this->lat,
                'lng' => $this->lng,
            ],
            'pov' => [
                'heading' => $this->heading ? $this->heading : 0,
                'pitch' => $this->pitch ? $this->pitch : 0,
            ]
        ]);
    }

    public function toLightArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
