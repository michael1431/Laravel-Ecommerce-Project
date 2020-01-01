<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Image;
use File;


class BrandsController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    // Index function for brand

    public function index(){

    	$brands = Brand::orderBy('id','desc')->get();
    	return view('backend.pages.brand.index', compact('brands'));

    	// with er poriborte compact o use korte pari, jeta dekbe brands name kono varaiable ache kina aikane.

    }

    public function create(){

    	return view('backend.pages.brand.create');
    }

    public function store(Request $request)
    {
    	// store the data 

    	// Validation

     $this->validate($request,[

    		'name' => 'required',
    		'image' => 'nullable|image',

    	],
    	[

    		'name.required' =>'Please provide a brand name',
    		'image.image' =>'Please provide a valid image with .jpg,.png,.jpeg extension',
    	]);

    	$brand = new Brand();
    	$brand->name = $request->name;
    	$brand->description = $request->description;

    	// code for inserting single image

        if($request->hasFile('image')){

            $image = $request->file('image');
    		// Name the image file
    		$img = time(). '.' .$image->getClientOriginalExtension();
    		$location ='images/brands/'.$img;

    		Image::make($image)->save($location);	
    		// save the image in location and also save this in db
    		
    		$brand->image = $img;
            }
    	
            // save the image into db
    	$brand->save();


    	session()->flash('success', 'A new Brands has been added successfully!!');

    	return redirect()->route('admin.brands');





    }


    public function edit($id){

        $brand = Brand::find($id);

        if(!is_null($brand)){

            return view('backend.pages.brand.edit',compact('brand'));

        }else{
            return redirect()->route('admin.brands');
        }
    }



     public function update(Request $request, $id) {

        // Validation

     $this->validate($request,[

            'name' => 'required',
            'image' => 'nullable|image',

        ],
        [

            'name.required' =>'Please provide a brand name',
            'image.image' =>'Please enter a image with .jpg,.png,.jpeg extension',
        ]);

        $brand = Brand::find($id);

        $brand->name = $request->name;
        $brand->description = $request->description;

        // code for inserting image

        if(count($request->image) > 0 ){

            // code for deletd old image from folder

            if(File::exists('images/brands'. $brand->image)){
                File::delete('images/brands'. $brand->image);
            }
            

            $image = $request->file('image');
            // Name the image file
            $img = time(). '.' .$image->getClientOriginalExtension();
            $location ='images/brands/'.$img;

            Image::make($image)->save($location);   
            // save the image in location and also save this in db
            
            $brand->image = $img;

            }
        

        $brand->save();


        session()->flash('success', 'Brand has been updated successfully!!');

        return redirect()->route('admin.brands');


    }

    

     public function delete($id)
    {
        # code...
        
        $brand = Brand::find($id);
        if(!is_null($brand)){
            // delete the brand image from file
            if(File::exists('images/brands/'.$brand->image)){
                File::delete('images/brands/'.$brand->image);
            }
            // then delete it from db
            $brand->delete();
        }
        session()->flash('success','Brand has been deleted successfully !!');
        return back();

    }


}
