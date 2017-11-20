<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    const ACTIVE = 'Active';
    const WON = 'Won';
    const LOST = 'Lost';

    protected $fillable = [
        'name',
        'team_id',
        'client_id',
        'user_id',
        'total_price',
        'confidence',
        'from_date',
        'to_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'team_id' => 'int',
        'client_id' => 'int',
        'user_id' => 'int',
        'total_price' => 'float',
        'confidence' => 'int',
    ];

    protected $dates = [
        'from_date',
        'to_date',
        'created_at',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billboardFaces()
    {
        return $this->belongsToMany(BillboardFace::class, 'proposal_billboard_face')
            ->withPivot('order', 'price')
            ->orderBy('order');
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
            'total_price' => $this->total_price,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'notes' => $this->notes,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'share_link' => url(route('proposal.public-view', ['proposal' => encrypt($this->id)])),
        ];
        return $data;
    }
    #endregion

}
