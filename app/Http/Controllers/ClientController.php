<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use DB;
use Hash;
use Datatables;
use Auth;
class ClientController extends Controller
{
	public function index()
	{

	
		return view('clients.index', [
		'active_menu' => 'clients',
		]);

	
	}
	
	public function datatable() 
	{
		
		$query = Clients::with('products');
		
		
		return Datatables::of($query)
		->addColumn('action', function(Clients $clients){
			return view('clients.chunk.action', [
			'id'        => $clients->id,
			'resource'  => 'clients',
			]);
		})
		->editColumn('status', function(Clients $clients){
			return Clients::$client_status[$clients->status];
		})
		->addColumn('client_price', function(Clients $clients){
			$price = 0 ;
			foreach($clients->products as $product){
				$price += $product->price * $product->amount  ;
			}
			
			return "€ " . $price ;
		})
		
		->make(true);
	}
	
	
	public function create(){
		
		return view('clients.create');
	}
	
	public function store(Request $request){
		
		$input = $request->only('email', 'first_name', 'last_name','address','status');
		$rules = config('validations.web.clients.create');
		if(!empty($request->card_number)){
			
			$rules['card_number'] 	= 'required|min:16|max:16';
			$rules['card_cvc'] 		= 'required|min:3|max:3';
			$rules['card_valid'] 	= 'required';
		}
		
		
		$this->validate($request, $rules);
		
		DB::transaction(function() use ($input, $request) {
			
			$client = Clients::create($input);
			if(!empty($request->card_number)){
				
				$client->card_number = $request->card_number;
				$client->card_cvc = $request->card_cvc;
				$client->card_valid = $request->card_valid;
				$client->save();
			}
		});
		
		return response()->view('message.success', array('message' => trans('Client has been successfully created') ));
	}
	
	
	public function edit($id) {
		$client = Clients::findOrFail($id);
		$price = 0 ; 
			foreach($client->products as $product){
				$price += $product->price * $product->amount  ;
			}
		return view('clients.update', [
		'client'        => $client,
		'price'			=> $price
		
		]);
	}

	public function update(Request $request, $id) {
		
		$input = $request->only('email', 'first_name', 'last_name','address','status');
		$rules = config('validations.web.clients.update');
		if(!empty($request->card_number)){
			
			$rules['card_number'] 	= 'required|min:16|max:16';
			$rules['card_cvc'] 		= 'required|min:3|max:3';
			$rules['card_valid'] 	= 'required';
		}
		
		
		$this->validate($request, $rules);
		
		DB::transaction(function() use ($input, $request, $id) {

			$client = Clients::findOrFail($id);
			if(!empty($request->card_number)){
				
				$client->card_number = $request->card_number;
				$client->card_cvc = $request->card_cvc;
				$client->card_valid = $request->card_valid;
			}
	
			$client->fill($input)->save();
		
			
		});
		return response()->view('message.success', array('message' => trans('Client has been updated successfully') ));
	}
	

	public function destroy($id) {
        $currentUser = Auth::user();

        if ( $currentUser->hasRole('admin') || $currentUser->hasRole('client_manager')) {
            

            Clients::destroy($id);

            return trans('Client has been successfully deleted');
        }

        return response( trans('Not enough permissions'), 406 );
    }

}