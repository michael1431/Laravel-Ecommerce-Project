<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Image;
use File;

class SlidersController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    
    public function index()
    {
        $sliders = Slider::orderBY('priority','asc')->get();
        return view('backend.pages.slider.index', compact('sliders'));
    }

   


    public function store(Request $request)
    {
        $this->validate($request,[

            'title' => 'required',
            'image' => 'required|image',
            'priority' => 'required',
            'button_link' => 'nullable|url'
        ],
        [

            'title.required' =>'Please provide a slider title',
            'image.required' =>'Please provide a valid slider image',
            'priority.required' =>'Please provide a slider priority',
            'image.image' =>'Please provide a valid image',
            'button_link.url' =>'Plese provide a valid slider button link'
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->image = $request->image;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;

         if($request->hasFile('image')){

            $image = $request->file('image');
            // Name the image file
            $img = time(). '.' .$image->getClientOriginalExtension();
            $location ='images/sliders/'.$img;

            Image::make($image)->save($location);   
            // save the image in location and also save this in db
            
            $slider->image = $img;

            }
        

        $slider->save();

     session()->flash('success', 'A new slider has been added successfully!!');

     return redirect()->route('admin.sliders');


    }


   
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[

            'title' => 'required',
            'image' => 'nullable|image',
            'priority' => 'required',
            'button_link' => 'nullable|url'
        ],
        [

            'title.required' =>'Please provide a slider title',
            'priority.required' =>'Please provide a slider priority',
            'image.image' =>'Please provide a valid image',
            'button_link.url' =>'Plese provide a valid slider button link'
        ]);

        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;


         //update image 

        if($request->hasFile('image')){

            // delete the old image from folder 
            if(File::exists('images/sliders/'.$slider->image)){
                File::delete('images/sliders/'.$slider->image);
            }

            $image = $request->file('image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $location ='images/sliders/'.$img;
            Image::make($image)->save($location);
            $slider->image=$img;
          }

          $slider->save();

     session()->flash('success', 'Slider has been updated successfully!!');

     return redirect()->route('admin.sliders');
    }

    

    public function delete($id)
    {
         $slider = Slider::find($id);
        if(!is_null($slider)){
            // Delete the image from file
            if(File::exists('images/sliders/'.$slider->image)){
                File::delete('images/sliders/'.$slider->image);
            
            }
            // Delete the image from database
            
            $slider->delete();
        }
        session()->flash('success','Slider has been deleted successfully !!');
        return back();

    }
    
}

