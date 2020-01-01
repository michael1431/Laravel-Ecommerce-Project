<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // db er field gulo Brand Model er 

    public $fillable = [

                'name',
                'description',
                'image'

        ];

 


     public function products()
    {

    	return $this->hashMany(Product::class);
    }
  
  
}
