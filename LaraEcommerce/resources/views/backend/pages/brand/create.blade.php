 @extends('backend.layouts.master')

 @section('content')

 <div class="main-panel">

        <div class="content-wrapper">
        

            <div class="card">

              <div class="card-header">

                Add Brand
                
              </div>


              <div class="card-body">

                 <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">

                  <!-- must be include csrf field when we used post method, it's return a token -->

                  @csrf

                  <!-- Show the error messages -->

                  @include('backend.partials.messages')

                    <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Brand Name">
                
                     </div>
                  <div class="form-group">

                    <label for="description">Description(optional)</label>
                    <textarea name="description" class="form-control" placeholder="Enter Brand Description Here...."></textarea>

                  </div>



                   <div class="form-group">

                    <label for="image">Brand Image(optional)</label>

                    <!-- Adding Image -->
                        
                        <input type="file" class="form-control" id="image" name="image">      
                
                   </div>
                 
                  <button type="submit" class="btn btn-success">Add Brand</button>
            </form>

                

              </div>

            </div>


          </div>
            
      </div>

 <!-- main-panel ends -->

  @endsection