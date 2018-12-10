<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps	= true;

	protected $table	= 'products';


	protected $fillable = [
		'title',
		'price',
		'amount',
		'stock',
		
	];
}
