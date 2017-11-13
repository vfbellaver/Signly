<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone1',
        'phone2',
        'fax',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zipcode',
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'fax' => $this->fax,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,
            'logo' => $this->logo,
            'slug' => $this->slug,
        ];
    }
    #endregion

}
