    @extends('frontend.layouts.master')

    @section('content')



<div class="container mt-2" style="margin-bottom: 200px!important;">



  <div class="row justify-content-center mb-5 mt-5">
     <div class="col-md-8">
         <div class="card">
           <div class="card-header">{{ __('Register') }}</div>
             <div class="card-body">
               <form method="POST" action="{{ route('register') }}">
          @csrf

        <div class="form-group row">
            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

            <div class="col-md-6">
                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
            </div>
        </div>



        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            </div>
        </div>

         <div class="form-group row">
            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>

            <div class="col-md-6">
                <input id="phone_no" type="text" class="form-control" name="phone_no" value="{{ old('phone_no') }}">

            </div>
        </div>

         <div class="form-group row">
            <label for="division_id" class="col-md-4 col-form-label text-md-right">{{ __('Division Name') }}</label>

            <div class="col-md-6">
                
                <select class="form-control" name="division_id" id="division_id">
                    <option value="">Please Select Your Division</option>

                    @foreach($divisions as $division)

                 <option value="{{ $division->id}}">{{$division->name}}</option>

                  @endforeach   

                </select>

            </div>
        </div>

        <div class="form-group row">
            <label for="district_id" class="col-md-4 col-form-label text-md-right">{{ __('District Name') }}</label>

            <div class="col-md-6">
                
                <select class="form-control" name="district_id" id="district_area">
                   <!-- <option value="">Please Select Your District</option>

                    @foreach($districts as $district)

                 <option value="{{ $district->id }}">{{$district->name}}</option>

                  @endforeach  --> 

                </select>

                
            </div>
        </div>

         <div class="form-group row">
            <label for="street_address" class="col-md-4 col-form-label text-md-right">{{ __('Street Address') }}</label>

            <div class="col-md-6">
                <input id="street_address" type="text" class="form-control" name="street_address" value="{{ old('street_address') }}">

            </div>
        </div>




        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control " name="password" >
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
  </div>
   </form>
     </div>
      </div>
         </div>
          </div>
            </div>




     @endsection
    @section('scripts')

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <script>
        
      /*  <!-- code for  select district from division --> */

      $("#division_id").change(function(){

        var division = $("#division_id").val();
        // send an ajax request to server with this division 
        $("#district_area").html("");

        var option = "";
        var url = "{{ url('/')}}";

        $.get(url+"/get-districts/"+division, function(data){
            // encode kore j data ta pabo oita parse korbo

            data = JSON.parse(data);
            // sob district niye asbo oi division er tai foreach use korbo

            data.forEach(function(element){

                option += " <option value = '"+ element.id +"'>"+ element.name +"</option>";

               
            });
            

             $("#district_area").html(option);
            
    

         });

    })


    

    </script>

    @endsection
