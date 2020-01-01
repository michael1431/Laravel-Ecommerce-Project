 @extends('backend.layouts.master')

 @section('content')

 <div class="main-panel">

        <div class="content-wrapper">
        

            <div class="card">

              <div class="card-header">

                Edit Brand
                
              </div>


              <div class="card-body">

                 <form action="{{ route('admin.brand.update',$brand->id) }}" method="post" enctype="multipart/form-data">

                  <!-- must be include csrf field when we used post method, it's return a token -->

                  @csrf

                  <!-- Show the error messages -->

                  @include('backend.partials.messages')

                    <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}">
                
                     </div>
                  <div class="form-group">

                    <label for="description">Description(Optional)</label>
                    <textarea name="description" class="form-control"> {{ $brand->description }} </textarea>

                  </div>


                   <div class="form-group">

                    <label for="old image">Brand Old Image</label><br>

                     <img src="{{asset('images/brands/'.$brand->image)}}" width="100"><br>

                 <label for="new image">Brand New Image(Optional)</label>

                        <input type="file" class="form-control" id="image" name="image">      
                
                   </div>
                 
                  <button type="submit" class="btn btn-primary">Update Brand</button>
            </form>

                

              </div>

            </div>


          </div>
            
      </div>

 <!-- main-panel ends -->

  @endsection