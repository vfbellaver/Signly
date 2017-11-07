<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    protected $fillable = [
        'read_at',
    ];

    protected $casts = [

    ];

    protected $dates = [
        'read_at'
    ];

    #region Relationships

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
            'type' => $this->type,
            'notifiable_id' => $this->notifiable_id,
            'notifiable_type' => $this->notifiable_type,
            'data' => $this->data,
            'read_at' => $this->read_at,
        ];
    }
    #endregion

}
