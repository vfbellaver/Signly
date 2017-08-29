<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class BillboardImage extends Model  {

	use Authenticatable, CanResetPassword;

	protected $table = 'billboard_image';

	protected $fillable = [
	    'image_name',
	    'image_location',
    ];

}
