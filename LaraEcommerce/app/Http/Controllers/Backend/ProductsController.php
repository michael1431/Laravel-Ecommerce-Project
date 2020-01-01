<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Image;

class ProductsController extends Controller
{

    
   public function __construct(){
        $this->middleware('auth:admin');
    }

    // product manage function 
    
    public function index(){

    	// show all the product to admin for managing

    	// called the product model class order by id and get all data
    	$products = Product::orderBy('id', 'desc')->get();

    	// by with method keep the variable products array in products

    	return view('backend.pages.product.index')->with('products',$products);
    }
   



    public function create(){
    	// product add page
    	return view('backend.pages.product.create');
    }


  
    public function edit($id){

    	// Using find method to find the id

    	$product = Product::find($id);

    	return view('backend.pages.product.edit')->with('product',$product);

    
    }



     public function store(Request $request){
    	
    	// Request method accept all input or form request

    	// Start Validation before save all the data in db

    	$request->validate([

                'title' => 'required|max:150',
                'description' => 'required',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|numeric',
                 'brand_id' => 'required|numeric',

            ]);


    	// Create a object for Product model

    	$product = new Product;

        // $product object diye Product class er database er field gulo access kortechi
        // $request variable diye form er field gulo bind kortechi

    	$product->title = $request->title;
    	$product->description = $request->description;
    	$product->price = $request->price;
    	$product->quantity = $request->quantity;

    	// Auto generate a slug for product such as samsung-galaxy

    	$product->slug = str_slug($request->title);
    	$product->category_id = $request->category_id;
    	$product->brand_id = $request->brand_id;
    	$product->admin_id = 1;

    	// called the save method to store the data in db

    	$product->save();

    	// When insert the data of the form in product table, we also insert the image in image table by using product id

    	/*
    	 Code For Adding Single Image

    	// ProductImage Model insert image

    	if($request->hasFile('product_image')){
    		// jodi product_image name kono field er request takhe
    		// Then we insert the image

    		$image = $request->file('product_image');

    		// Name the image file

    		$img = time(). '.' .$image->getClientOriginalExtension();

            // public_path is a build in function in laravel jetate 
            amra image er path set kore dite pari.

    		$location = public_path('images/products/'.$img);

    		Image::make($image)->save($location);

    		// Now save the image in db 

    		$product_image = new ProductImage;

    		$product_image->product_id = $product->id;
    		$product_image->image = $img;

    		$product_image->save();

    	} */

    	// Code For Adding Multiple Image

    	if(count($request->product_image) > 0 ){

    		// As we send an array , so continue a foreach loop
            // For unique image we take a variable i 
            $i = 0;

    		foreach($request->product_image as $image){

    		// Name the image file

    		$img = time(). $i .'.' .$image->getClientOriginalExtension();
    		$location ='images/products/'.$img;

    		Image::make($image)->save($location);

    		// Now save the image in db 

    		$product_image = new ProductImage;

    		$product_image->product_id = $product->id;
    		$product_image->image = $img;

    		$product_image->save();
            $i++;




    		}


    	}

    	// now redirect the page

    	return redirect()->route('admin.products');



    }

    // code for product update


     public function update(Request $request, $id){
    	
    	// Request method accept all input or form request

    	// Start Validation before save all the data in db

    	$request->validate([

                'title' => 'required|max:150',
                'description' => 'required',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|numeric',
                 'brand_id' => 'required|numeric',
              

            ]);


    	// Find the id from the product model

    	$product = Product::find($id);

    	$product->title = $request->title;
    	$product->description = $request->description;
    	$product->price = $request->price;
    	$product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
    	
    	$product->save();


        if(count($request->product_image) > 0 ){

            $i = 0;

            foreach($request->product_image as $image){

            $img = time(). $i .'.' .$image->getClientOriginalExtension();
            $location ='images/products/'.$img;

            Image::make($image)->save($location);

            $product_image = new ProductImage;

            $product_image->product_id = $product->id;
            $product_image->image = $img;

            $product_image->save();
            $i++;


            }


        }

    	
    	// now redirect the page

    	return redirect()->route('admin.products');



    }

    // code for delete product

    public function delete($id){

    	$product = Product::find($id);

    	if(!is_null($product)){


    		$product->delete();
    	}

        // we have to delete the images from db and path also

        foreach($product->images as $img){

            $file_name = $img->image;
            if(file_exists("images/products/". $file_name)){
                unlink("images/products/". $file_name);
            }

            $img->delete();

        }

    	// show a msg 

    	session()->flash('success','Product Has Deleted Successfully !!');

    	// same page e phire asbe so return back function use korle hobe

    	return back();



    }




}
