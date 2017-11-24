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

    const ADMIN = 'Admin';
    const SUPER_ADMIN = 'DevSquad';
    const ACCOUNT_OWNER = 'Account Owner';
    const ACCOUNT_MEMBER = 'Account Member';

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
        'timezone',
        'team_id',
    ];

    protected $dates = [
        'card_expiration',
        'trial_ends_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => 'boolean',
        'lat' => 'float',
        'lng' => 'float',
        'team_id' => 'int',
    ];

    #region Attributes

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function notifications()
    {
        $relation = $this->hasMany(Notification::class, 'notifiable_id');
        $relation->where('notifiable_type', 'users');
        return $relation;
    }

    public function getSubscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    public function getIsTeamOwnerAttribute()
    {
        $isTeamOwner = $this->team->owner_id == $this->id;
        return $isTeamOwner;
    }

    public function canImpersonate()
    {
        $roles = $this->roles->pluck('name')->all();
        if (session()->exists(config('laravel-impersonate.session_key'))) {
            return true;
        }
        return in_array(self::ADMIN, $roles);
    }

    public function canBeImpersonated()
    {
        $roles = $this->roles->pluck('name')->all();
        return !in_array(self::SUPER_ADMIN, $roles);
    }

    public function isImpersonated()
    {
        return session()->exists(config('laravel-impersonate.session_key'));
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

        $subscription = $this->getSubscription()->get()->first();

        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'photo_url' => $this->photo_url,
            'email' => $this->email,
            'role' => $role,
            'roles' => $this->roles->pluck('name')->all(),
            'status' => $this->status,
            'team' => $this->team_id ? $this->team->toArray() : null,
            'subscription' => $subscription ? $subscription->toArray() : null,
            'pending' => $this->invitation_token != null,
            'impersonated' => $this->isImpersonated(),

            'stripe_id' => $this->stripe_id,
            'card_brand' => $this->card_brand,
            'card_expiration' => $this->card_expiration,
            'card_last_four' => $this->card_last_four,
            'trial_ends_at' => $this->trial_ends_at,

            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,

            'timezone' => $this->timezone,
        ];
    }

    #endregion
}
