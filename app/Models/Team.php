<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'fax',
        'address',
        'logo',
        'owner_id'
    ];

    protected $casts = [
        'owner_id' => 'int',
    ];

    protected $dates = [

    ];

    #region Relationships{relationships}
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    #endregion

    #region Custom Attributes

    #endregion

    #region Queries

    #endregion

    #region Conversions
    public function toArray()
    {
        return array_merge(parent::toArray(), [

        ]);
    }
    #endregion

}
