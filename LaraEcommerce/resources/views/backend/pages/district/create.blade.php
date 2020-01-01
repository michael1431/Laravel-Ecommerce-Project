 @extends('backend.layouts.master')

 @section('content')

 <div class="main-panel">

        <div class="content-wrapper">
        

            <div class="card">

              <div class="card-header">

                Add District
                
              </div>


              <div class="card-body">

                 <form action="{{ route('admin.district.store') }}" method="post" enctype="multipart/form-data">

                  <!-- must be include csrf field when we used post method, it's return a token -->

                  @csrf

                  <!-- Show the error messages -->

                  @include('backend.partials.messages')

                    <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter District Name">

                    </div>

                    <div class="form-group">

               <label for="division_id">Select a division for this district</label>
                   <select class="form-control" name="division_id">
              <option value="">Please select a division for this disctrict</option>
                     
                    @foreach($divisions as $division)

                  <option value="{{ $division->id }}">{{ $division->name }}</option>

                    @endforeach

                   </select>
                 
                    
                    </div>
                
                 
                 <button type="submit" class="btn btn-success">Add District</button>
            </form>

                

              </div>

            </div>


          </div>
            
      </div>

 <!-- main-panel ends -->

  @endsection