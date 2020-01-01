<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    // product frontend homepage method

    public function index()
    {

    	// called the product model class order by id and get all the value form db
    	$products = Product::orderBy('id', 'desc')->paginate(9);

    	// by with method  keep the variable products array in products
        // ki name amra product ta pete cacchi oi page e seta first e likbo then amdr j variable ta ache jeta model tekhe pabo oita likbo

    	return view('frontend.pages.product.index')->with('products',$products);
    }

    public function show($slug){
    	// code for show the product by slug field
        // akta product show korar jonno first
        $product = Product::where('slug',$slug)->first();
        if(!is_null($product)){

            return view('frontend.pages.product.show',compact('product'));

        }else{

            session()->flash('errors','Sorry there are no products by this URL....');

            return redirect()->route('products');
        }
    }

}
