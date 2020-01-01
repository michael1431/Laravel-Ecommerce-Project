<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    

    public $fillable = [

    			'user_id',
    			'ip_address',
    			'order_id',
    			'product_id',
    			'product_quantity'

    ];

    public function user(){

    	// User and order model same directory te ache so kono folder er name dite hoin ni,na takle App\Models\.....dite hoto

    	return $this->belongsTo(User::class);
    }

      public function order(){

    	return $this->belongsTo(Order::class);
    }

      public function product(){

    	return $this->belongsTo(Product::class);
    }


    //Total cart koita ache oita ber korbo

    public static function totalCarts(){

        if(Auth::check()){
            // jodi authenticate user hoi tahole ter sob total items niye asbe

             $carts =Cart::where('user_id',Auth::id())
                     ->where('order_id',NULL)
                     ->get();

        }else{
            $carts =Cart::where('ip_address', request()->ip())->where('order_id',NULL)->get();

        }

       
        return $carts;
    }



    // Total cart er item or quantity ber korbo

    public static function totalItems(){

       
        if(Auth::check()){
            // jodi authenticate user hoi tahole ter sob total items niye asbe

             $carts =Cart::where('user_id',Auth::id())
                     ->where('order_id',NULL)
                     ->get();

        }else{
            $carts =Cart::where('ip_address', request()->ip())->where('order_id',NULL)->get();

        }

        $total_item =0;
        foreach($carts as $cart){
            $total_item += $cart->product_quantity;
        }

        return $total_item;
    }

}
