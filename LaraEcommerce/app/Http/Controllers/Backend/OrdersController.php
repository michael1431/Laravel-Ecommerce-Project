<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;
class OrdersController extends Controller
{
    

    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    

    public function index(){

    	$orders = Order::orderBy('id','desc')->get();
    	return view('backend.pages.orders.index', compact('orders'));

    }


    public function show($id){

    	$order = Order::find($id);

        // jakhon e admin order show korbe tkn seta seen hoye jabe

        $order->is_seen_by_admin = 1;

        $order->save();
    	return view('backend.pages.orders.show', compact('order'));
    }



    public function chargeUpdate(Request $request, $id){

        $order = Order::find($id);
        $order->shipping_charge = $request->shipping_charge;
        $order->custom_discount = $request->custom_discount;
        $order->save();
        session()->flash('success', 'Order shipping cost and discount has changed...!!');
        return back();
    }

    public function generateInvoice($id){

        $order = Order::find($id);

        // css korar jonno age view ta dektechi
      //  return view('backend.pages.orders.invoice', compact('order'));
        $pdf = PDF::loadView('backend.pages.orders.invoice', compact('order'));

        return $pdf->stream('invoice.pdf');
        //return $pdf->download('invoice.pdf');
        // stream used for see the pdf.we also  used download here.


    }


    public function completed($id){

        $order = Order::find($id);

        if($order->is_completed){
            // jodi order complete korar por admin order cancel korte cai tahole 0 kore dibo
            $order->is_completed = 0;
        }else{
            // r jodi order complete kora na takhe tahole 1 kore dibo.
            $order->is_completed = 1;
        }

        $order->save();
        session()->flash('success', 'Order Completed Status Changed...!!');
        return back();
    }

    public function paid($id){

        $order = Order::find($id);

        if($order->is_paid){
            // paid kora takle cancel korte caile is paid 0 kore dibe
            $order->is_paid = 0;
        }else{
            // otherwise 1 kore dibe.That means it is paid
            $order->is_paid = 1;
        }

        $order->save();
        session()->flash('success', 'Order Paid Status Changed...!!');
        return back();
    }


}
