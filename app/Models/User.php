<?php

namespace App\Models;

use Artesaos\Defender\Role;
use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use PHPUnit\Util\Log\TeamCity;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasDefender, Billable;

    const SUPER_ADMIN = 'slc';
    const ADMIN = 'admin';
    const USER = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'photo_url',
        'invitation_token',
        'status',
        'stripe_id',
        'card_brand',
        'card_expiration',
        'card_last_four',
        'trial_ends_at',
        'address',
        'lat',
        'lng',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => 'boolean',
        'lat' => 'float',
        'lng' => 'float',
    ];

    #region Attributes

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }
    #endregion

    #region Queries
    public static function invitationTokenIsValid($token)
    {
        return static::whereToken($token)->exists();
    }

    public static function byToken($token)
    {
        return static::whereToken($token)->firstOrFail();
    }

    private static function whereToken($token)
    {
        return static::query()->where('invitation_token', '=', $token);
    }
    #endregion

    #region Conversions
    public function toArray()
    {
        $role = [];
        if ($this->role) {
            $role = [
                'id' => $this->role->id,
                'name' => $this->role->name
            ];
        };

        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'photo_url' => $this->photo_url,
            'email' => $this->email,
            'role' => $role,
            'status' => $this->status,
            'team' => $this->team_id ? $this->team->toArray() : null,
            'pending' => $this->invitation_token != null,
            'stripe_id' => $this->stripe_id,
            'card_brand' => $this->card_brand,
            'card_expiration' => $this->card_expiration,
            'card_last_four' => $this->card_last_four,
            'trial_ends_at' => $this->trial_ends_at,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }

    #endregion
}
