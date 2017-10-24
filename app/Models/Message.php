<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'subject',
        'message',
        'visualized',
        'user_id',
    ];


    #region Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
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
            'subject' => $this->subject,
            'message' => $this->message,
            'visualized' => $this->visualized,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
    #endregion
}
