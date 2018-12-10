<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {

	use SoftDeletes, EntrustUserTrait {
		SoftDeletes::restore insteadof EntrustUserTrait;
		EntrustUserTrait::restore insteadof SoftDeletes;
	}

	const USER_STATUS_UNACTIVE  = 0;
	const USER_STATUS_ACTIVE    = 1;

	public $timestamps	= true;

	protected $table	= 'users';

	protected $fillable = [
		'facebook_id',
		'first_name',
		'last_name',
		'password',
		'phone',
		'email',
		'status',
		'remember_token',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	


}
