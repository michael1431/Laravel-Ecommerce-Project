<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Parent category access korar rule Laravel e ,one to one relation
    // every category has one parent category

    public function parent()
    {

    	return $this->belongsTo(Category::class,'parent_id');
    }

    // akta categoryr onek gulo products takte pare so we need  hashMany
    // same table e hole belongs to, onno table jemon products table er jonno hash many


     public function products()
    {

    	return $this->hasMany(Product::class);
    }

    /*

    check if this category is the child category of that parent category

    */

    public static function ParentOrNotCategory($parent_id,$child_id){

        $categories = Category::where('id',$child_id)->where('parent_id',$parent_id)->get();

        if(!is_null($categories)){
            return true;
        }else{
            return false;
        }
    }
  
}
