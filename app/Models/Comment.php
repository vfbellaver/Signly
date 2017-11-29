<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Timezone;

class Comment extends Model
{
    protected $fillable = [
        'team_id',
        'proposal_id',
        'user_id',
        'from_name',
        'comment',
    ];

    protected $casts = [

        'visualized' => 'boolean',

    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }


    public function toArray()
    {
        /** @var Carbon $date */
        $date = $this->created_at;
        $createdAt = Timezone::convertFromUTC($date->timestamp, config('request.timezone'), 'm.d.Y h:i:s A');

        return array_merge(parent::toArray(), [
            'name' => $this->user ? $this->user->name : $this->from_name,
            'created_at' => $createdAt,
            'visualized' => $this->visualized,
        ]);
    }

}
