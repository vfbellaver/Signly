<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'user_id' => 'int',
        'quantity' => 'int',
    ];

    protected $dates = [
        'trial_ends_at',
        'ends_at',
    ];

    #region Attributes

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #endregion

    #region Queries

    #endregion

    #region Conversions
    public function toArray()
    {
        return [
            'id' => (int)$this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'stripe_id' => $this->stripe_id,
            'stripe_plan' => $this->stripe_plan,
            'quantity' => $this->quantity,
            'trial_ends_at' => $this->trial_ends_at,
            'ends_at' => $this->ends_at,
        ];
    }

    #endregion
}
