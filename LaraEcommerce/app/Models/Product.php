<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function images(){
    	// create a images function which includes many images
    	// this is one to many relationship
    	// akta product er onek gulo image takte pare so hashmany use korchi
    	return $this->hasMany(ProductImage::class);

    	// We can do this by using this method also
    	//return $this->hasMany('App/Models/ProductImage');
    }

    public function category(){
    	// protita product er akta category id takbe so belongs to use korbo

    	return $this->belongsTO(Category::class);
    	// jehetu laravel e by defeaut category_id takhe ,so class er por r kono kichu likte hobe na.
    	// category id ta product table eo ache, jodi onno name takto tahole add korte hoto jmn-> class,'main_category'
    }

    public function brand(){
    	return $this->belongsTO(Brand::class);
    }
}
