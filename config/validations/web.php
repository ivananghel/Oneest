<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24.03.2017
 * Time: 15:52
 */

return [
	
	'user' => [
		'create' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
			'email'                     => 'required|email|unique:users,email',
			'upload_file'               => 'file|mimes:jpeg,jpg,png',
			'password'                  => 'required|min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		],
		'update' => [
			'first_name'                => 'required|max:255',
			'last_name'                 => 'required|max:255',
			'email'                     => 'required|email|unique:users,email',
			'photo'                     => 'file|mimes:jpeg,jpg,png',
			'password'                  => 'min:4|max:255|confirmed',
			'password_confirmation'     => 'min:4|max:255'
		]
	],
	'clients' => [
		'create' => [
			'first_name'                => 'required|min:3|max:25',
			'last_name'                 => 'required|min:3|max:25',
			'email'                     => 'required|email',

		],
		'update' => [
			'first_name'                => 'required|min:3|max:25',
			'last_name'                 => 'required|min:3|max:25',
			'email'                     => 'required|email',
		]
		],
	'product' => [
		'create' => [
			'title'                		=> 'required',
			'price'                 	=> 'required',
			'amount'                    => 'required',
			'stock'                     => 'required',

		],
		'update' => [
			'title'                		=> 'required',
			'price'                 	=> 'required',
			'amount'                    => 'required',
			'stock'                     => 'required',

		]
	]
];