<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'client_id',
        'team_id',
        'expires_on'
    ];

    protected $casts = [
        'client_id' => 'int',
        'team_id' => 'int',
    ];

    protected $dates = [
        'expires_on' => 'Y-m-d'
    ];

    #region Relationships

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function billboardFaces()
    {
        return $this->belongsToMany(BillboardFace::class, 'proposal_billboard_face');
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
        ];
    }
    #endregion

}
