<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Image;
use File;


class CategoriesController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    // Index function for category

    public function index(){

    	$categories = Category::orderBy('id','desc')->get();
    	return view('backend.pages.category.index', compact('categories'));

    	// with er poriborte compact o use korte pari, jeta dekbe categories name kono varaiable ache kina aikane.

    }

    public function create(){

    	// j category gulor parent id null oi gulo show korabo

    	$main_categories = Category::orderBy('name','desc')->where('parent_id', NULL)->get();


    	return view('backend.pages.category.create', compact('main_categories'));
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

    		'name.required' =>'Please provide a category name',
    		'image.image' =>'Please enter a image with .jpg,.png,.jpeg extension',
    	]);

    	$category = new Category();

    	$category->name = $request->name;
    	$category->description = $request->description;
    	$category->parent_id = $request->parent_id;

    	// code for inserting single image

    	 if($request->hasFile('image')){

            $image = $request->file('image');
    		// Name the image file
    		$img = time(). '.' .$image->getClientOriginalExtension();
    		$location ='images/categories/'.$img;

    		Image::make($image)->save($location);	
    		// save the image in location and also save this in db
    		
    		$category->image = $img;
            }
    	

    	$category->save();


    	session()->flash('success', 'A new category has been added successfully!!');

    	return redirect()->route('admin.categories');





    }


    public function edit($id){

        $main_categories = Category::orderBy('id','desc')->where('parent_id', NULL)->get();

        $category = Category::find($id);

        if(!is_null($category)){

            return view('backend.pages.category.edit', compact('category','main_categories'));

        }else{
            return redirect()->route('admin.categories');
        }
    }


    //  updated category insert to db
    public function update(Request $request,$id)
    {
        # validation
        $this->validate($request,[
           'name'=>'required',
           'image'=>'nullable|image',
        ],
        [
           'name.required' =>'Please provide a category name',
           'image.image' =>'Please provide a valid image with .jpg, .png, .jpeg, .gif extension..',

        ]);
        // find the id of ther category
        $category = Category::find($id);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        //update image 

        if($request->hasFile('image')){

            // delete the old image from folder
            
            if(File::exists('images/categories/'.$category->image)){
                File::delete('images/categories/'.$category->image);
            }

            $image = $request->file('image');
            $img = time().'.'.$image->getClientOriginalExtension();

            $location ='images/categories/'.$img;
            Image::make($image)->save($location);

            $category->image=$img;
          }
          // save the new image
            $category->save(); 

            session()->flash('success','Category has updated successfully');
            return redirect()->route('admin.categories');
    }

    

     public function delete($id)
    {
        # code...
        
        $category = Category::find($id);
        if(!is_null($category)){

            // if it is parent category,then delete all its sub category
            if($category->parent_id == NUll){
              // delete sub categories
              $sub_categories = Category::orderBy('id','desc')->where('parent_id',$category->id)->get();
              foreach ($sub_categories as $sub) {
                # delete sub images from folder
                if(File::exists('images/categories/'.$sub->image)){
                    File::delete('images/categories/'.$sub->image);
                  }
                $sub->delete(); // delete
              }
            }
            
            // delete the category image from file
            if(File::exists('images/categories/'.$category->image)){
                File::delete('images/categories/'.$category->image);
            }
            // then delete the category image from db
            $category->delete();
        }
        session()->flash('success','Category has deleted successfully !!');
        return back();

    }


}
