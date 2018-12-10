<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Clients;
use App\Models\Products;
use App\Models\ProductClient;
use DB;
use Hash;
use Datatables;
use Auth;
class ProductsController extends Controller
{
    public function index()
	{
		return view('products.index', [
		'active_menu' => 'products',
		]);
	}
	
	public function datatable() 
	{
		
		$query = Products::all();
		
		return Datatables::of($query)
		->addColumn('action', function(Products $products){
			return view('products.chunk.action', [
			'id'        => $products->id,
			'resource'  => 'products',
			]);
		})
		->editColumn('stock', function(Products $products){
			
			return ($products->stock ? "On" : "Off");
		})

		->make(true);
	}
	
	
	public function create(){
		$clients = Clients::all();
		return view('products.create',[
            'clients'=>$clients
        ]
            );
	}
	
	public function store(Request $request){
     
		$input = $request->only('title', 'price', 'amount','stock');
		$rules = config('validations.web.product.create');
		
	
		$this->validate($request, $rules);
       
		DB::transaction(function() use ($input, $request) {
		
			$product = Products::create($input);
			if (isset($request->clients)) {     
                    foreach ($request->clients as $client_id) {

					
						$client = Clients::findOrFail($client_id);
					
						$product_client = ProductClient::create();
						
						$product_client->client()->associate($client);

                        $product_client->product()->associate($product);
                        $product_client->save();
                    }
                }
		});
		
		return response()->view('message.success', array('message' => trans('Products has been successfully created') ));
	}
	
	
	public function edit($id) {

		$clients = Clients::all();
		$client_product = array_column(ProductClient::select('client_id')->where('product_id',$id)->get()->toArray(),'client_id');

		$product = Products::findOrFail($id);
	
		return view('products.update', [
		'product'          => $product,
		'clients'          => $clients,
		'client_product'          => $client_product,
		
		]);
	}

	public function update(Request $request, $id) {
		$input = $request->only('title', 'price', 'amount','stock');
		$rules = config('validations.web.product.update');
		
	
		$this->validate($request, $rules);
       
		DB::transaction(function() use ($input, $request ,$id) {
		
			$product = Products::findOrFail($id);

			$product->fill($input)->save();
			if (isset($request->clients)) {   
				
                    foreach ($request->clients as $client_id) {
						$client = Clients::findOrFail($client_id);
					
						$product_client = ProductClient::create();
						
						$product_client->client()->associate($client);

                        $product_client->product()->associate($product);
                        $product_client->save();
                    }
            }else{
				ProductClient::where('product_id', $product->id)->delete();  
			}
		});
		
		return response()->view('message.success', array('message' => trans('Products has been updated successfully') ));
	}
	

	public function destroy($id) {
        $currentUser = Auth::user();

        if ( $currentUser->hasRole('admin') || $currentUser->hasRole('manager')) {

            Products::destroy($id);

            return trans('Product has been successfully deleted');
        }

        return response( trans('Not enough permissions'), 406 );
    }

}
