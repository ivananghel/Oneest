<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    public $timestamps	= true;

	protected $table	= 'clients';
	static $client_status	= [
		0 => "Out",
		1 => "Active",
		2 => "Stand By"
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'address',
		'email',
		'status',
        'card_number',
        'card_cvc',
        'card_valid'
	];


	
	public function products() {
        return $this->belongsToMany(Products::class, 'product_client', 'client_id', 'product_id');
    }
}
