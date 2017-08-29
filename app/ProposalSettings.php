<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class ProposalSettings extends Model  {

	use Authenticatable, CanResetPassword;

	protected $table = 'proposal_settings';

    public $timestamps = false;

	protected $fillable = [
	    'path_image',
        'user_street',
        'user_state',
        'user_phone',
        'user_city',
        'user_zipcode',
        'website'
    ];

}
