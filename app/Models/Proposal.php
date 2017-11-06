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
            'team_id' => $this->team_id,
            'client_id' => $this->client_id,
            'client' => $this->client->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
    #endregion

}
