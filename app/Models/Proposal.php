<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'name',
        'team_id',
        'client_id',
    ];

    protected $casts = [
        'team_id' => 'int',
        'client_id' => 'int',
    ];

    protected $dates = [
    ];

    #region Relationships
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function billboardFaces()
    {
        return $this->belongsToMany(BillboardFace::class, 'proposal_billboard_face');
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
            'name' => $this->name,
            'team_id' => $this->team_id,
            'client_id' => $this->client_id,
            'client' => $this->client->toArray(),
            'billboard_faces' => $this->billboardFaces->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
        return $data;
    }
    #endregion

}
