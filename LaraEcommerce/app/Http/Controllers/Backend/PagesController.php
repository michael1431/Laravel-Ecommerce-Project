<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductImage;
use Image;

class PagesController extends Controller

{

	 public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        
    	// admin index page
    	return view('backend.pages.index');
    }





}
