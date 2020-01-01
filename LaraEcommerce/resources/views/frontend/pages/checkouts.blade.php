@extends('frontend.layouts.master')
@section('content')

<div class="container margin-top-20 mb-2">

  <div class="card card-body">
    
        <h3>Confirm Items</h3>
        <hr>

        <div class="row">
            <div class="col-md-7 border-right">


              @foreach(App\Models\Cart::totalCarts() as $cart)

                <p>
                  {{ $cart->product->title}} - 
                  <strong>{{ $cart->product->price }} Taka</strong>
                  - {{ $cart->product_quantity}} Item

                </p>
                
               @endforeach
              
            </div>

            <div class="col-md-5">

               @php

                $total_price = 0;
                
                @endphp


               @foreach(App\Models\Cart::totalCarts() as $cart)

               @php

                $total_price += $cart->product->price * $cart->product_quantity;
                
                @endphp

               @endforeach

              <p>Total Price: <strong>{{ $total_price }}</strong> Taka</p> 

              <p>Total Price With Shipping Cost: <strong>{{ $total_price + App\Models\Setting::first()->shipping_cost }}</strong> Taka</p>
              
            </div>
          
          

        </div>

       <p>
        <a href="{{ route('carts') }}">Change Cart Items</a>
       </p>
      

  </div>


      <div class="card card-body mt-2 mb-4">
        
            <h3>Shipping Address</h3>
             <form method="POST" action="{{ route('checkouts.store') }}" class="mb-5">
          @csrf

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::check() ? Auth::user()->first_name.' '.Auth::user()->last_name : ''}}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
           </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
         </div>

         <div class="form-group row">
            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>

            <div class="col-md-6">
                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ Auth::check() ? Auth::user()->phone_no : '' }}" required autocomplete="phone_no">

                @error('phone_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
         </div>

         

          <div class="form-group row">
            <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address ') }}</label>

            <div class="col-md-6">
                <textarea id="shipping_address" rows="4" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" required autocomplete="shipping_address">{{ Auth::check() ? Auth::user()->shipping_address : '' }}</textarea>

                @error('shipping_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>

           <div class="form-group row">
            <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Additional Message(Optional) ') }}</label>

            <div class="col-md-6">
                <textarea id="message" rows="4" class="form-control @error('message') is-invalid @enderror" name="message" ></textarea>

                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="payment_method" class="col-md-4 col-form-label text-md-right">Select A Payment Method</label>

            <div class="col-md-6">

              <select class="form-control" name="payment_method_id" required="1" id="payments">
                
                <option value="">Please Select A Payment Method</option>

                @foreach($payments as $payment)

          <option value="{{ $payment->short_name }}">{{ $payment->name }}</option>

                @endforeach

              </select>


              <!-- code for different payment method -->

              @foreach($payments as $payment)

                @if($payment->short_name == "cash")

               <div id="payment_{{ $payment->short_name }}" class="alert alert-success mt-2 hidden">

                <h3>For cash in there is nothing necessary.Just Click Finish Order..
                <br>
         <small>You will get your Product in two or three business days...</small>

                </h3>
                </div>
              
                @else


                <div id="payment_{{ $payment->short_name }}" class="alert alert-success mt-2 hidden">

                <h3>{{ $payment->name}} Payment</h3>
                <p>
                 <strong>{{ $payment->name}} No: {{ $payment->no }}</strong> 
                 <br>
                  <strong>Account Type: {{ $payment->type }}</strong>  
                </p>

                <div class="alert alert-success">
                  Please send the above money to this bikash number and write your transaction id below...
                </div>

              </div>

                @endif
                

              @endforeach

                     <input type="text" name="transaction_id" id="transaction_id" class="form-control hidden" placeholder="Enter Transaction Code Here..">


               
            </div>

          </div>


         <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success center">
                    {{ __('Order Now') }}
                </button>
            </div>
        </div>

 </form>



      </div>


</div>

    <!-- code for jquery to bring individual payment method cart-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

              <script>
                
                //js code 

                $("#payments").change(function(){
                  // select box er kono kichu change korle ai kaj gulo hobe

                  $payment_method = $("#payments").val();

                  if($payment_method == "cash"){

                    $("#payment_cash").removeClass('hidden');
                    $("#payment_bkash").addClass('hidden');
                    $("#payment_rocket").addClass('hidden');
                    $("#transaction_id").addClass('hidden');

                  }else if($payment_method == "bkash"){
                      $("#payment_bkash").removeClass('hidden');
                      $("#payment_rocket").addClass('hidden');
                      $("#payment_cash").addClass('hidden');
                      $("#transaction_id").removeClass('hidden');

                  }else if($payment_method == "rocket"){
                      $("#payment_rocket").removeClass('hidden');
                      $("#payment_bkash").addClass('hidden');
                      $("#payment_cash").addClass('hidden');
                      $("#transaction_id").removeClass('hidden');
                  }

                })

              </script>

@endsection