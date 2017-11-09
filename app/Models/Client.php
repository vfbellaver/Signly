<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use Notifiable;

    protected $fillable = [
        'company_name',
        'logo',
        'first_name',
        'last_name',
        'email',
        'address_line1',
        'address_line2',
        'city',
        'zipcode',
        'state',
        'phone1',
        'phone2',
        'fax',
        'team_id',
    ];

    protected $casts = [
        'team_id' => 'int',
    ];

    protected $dates = [
    ];

    #region Relationships
    public function team()
    {
        return $this->belongsTo(Team::class);
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
            'company_name' => $this->company_name,
            'logo' => $this->logo,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
            'state' => $this->state,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'fax' => $this->fax,
        ];
    }
    #endregion

}
