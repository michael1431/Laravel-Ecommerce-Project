<?php
/*
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Auth;

class CartsController extends Controller
{
    
    
   
    public function store(Request $request)

    {
        // Check validation.

        $this->validate($request,[

            'product_id' => 'required'
        ],
        [
            'product_id.required' =>'Please give a product'

        ]);



        if(Auth::check()){
            // authenticate user kina check kortechi

            $cart =Cart::where('user_id',Auth::id())
                 ->where('product_id',$request->product_id)
                 ->where('order_id',NULL)
                 ->first();

        }else{

               $cart =Cart::where('ip_address',request()->ip())
                     ->where('product_id',$request->product_id)
                     ->where('order_id',NULL)
                     ->first();

        }

        
         if(!is_null($cart)){
            //Product ta already card e exist takle seta increment hobe
            $cart->increment('product_quantity');

         }else{

        $cart = new Cart();

        if(Auth::check()){
            // Jodi authenticate user takhe tahole check korbe
            $cart->user_id = Auth::id();
        }

        // Authenticate user na holeo product order korte parbe ip address diye
        $cart->ip_address = request()->ip();
        $cart->product_id = $request->product_id;
        $cart->save();

         }

        
       return  json_encode(['status'=>'success', 'Message'=>'Item added to cart','totalItems'=>Cart::totalItems()]);
        
    }


*/
  
}
