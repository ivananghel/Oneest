<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductClient extends Model
{
  

    public $timestamps = true;
	protected $table = 'product_client';
	protected $fillable = [
		'client_id',
		'product_id',
		
	];
	 public function client()
    {
        return $this->belongsTo(Clients::class);
    }
     public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
