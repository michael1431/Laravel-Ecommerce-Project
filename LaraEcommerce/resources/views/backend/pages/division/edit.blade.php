 @extends('backend.layouts.master')

 @section('content')

 <div class="main-panel">

        <div class="content-wrapper">
        

            <div class="card">

              <div class="card-header">

                Edit Division
                
              </div>


              <div class="card-body">

                 <form action="{{ route('admin.division.update',$division->id) }}" method="post" enctype="multipart/form-data">

                  <!-- must be include csrf field when we used post method, it's return a token -->

                  @csrf

                  <!-- Show the error messages -->

                  @include('backend.partials.messages')

                    <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $division->name }}">
      
                     </div>

                  <div class="form-group">

                    <label for="priority">prioirity</label>
                    <input type="text" name="priority" class="form-control" value="{{$division->priority}}">

                  </div>

                 
              <button type="submit" class="btn btn-primary">Update Division</button>
            </form>

                

              </div>

            </div>


          </div>
            
      </div>

 <!-- main-panel ends -->

  @endsection