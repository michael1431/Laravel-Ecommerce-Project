<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Auth;

class CartsController extends Controller
{
    
    public function index()
    {
        
        return view('frontend.pages.carts');

    }

   
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

        
        session()->flash('success','Product has added to cart');
        return back();
        
    }

    

   

   

  
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        if(!is_null($cart)){

            $cart->product_quantity = $request->product_quantity;
            $cart->save();

        }else{
            return redirect()->route('carts');
        }

        session()->flash('success', 'Cart Item has updated successfully!!');

        return back();
    }

    
    public function destroy($id)
    {
        $cart = Cart::find($id);

        if(!is_null($cart)){
            $cart->delete();

        }else{
            return redirect()->route('carts');
        }

        session()->flash('sticky_error', 'Cart Item has deleted successfully!!');

        return back();
    }
}
