<?php

namespace App\Models;

use Artesaos\Defender\Role;
use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use PHPUnit\Util\Log\TeamCity;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasDefender;

    const SUPERADMIN = 'slc';
    const ADMIN = 'admin';
    const USER = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_url',
        'invitation_token',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    #region Attributes

    public function team()
    {
        return $this->belongsTo(Team::class);
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
        return static::where('invitation_token', '=', $token);
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
            'team' => $this->team->toArray(),
            'pending' => $this->invitation_token != null
        ];
    }

    #endregion
}
