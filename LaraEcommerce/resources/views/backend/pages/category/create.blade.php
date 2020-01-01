 @extends('backend.layouts.master')

 @section('content')

 <div class="main-panel">

        <div class="content-wrapper">
        

            <div class="card">

              <div class="card-header">

                Add Category
                
              </div>


              <div class="card-body">

                 <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">

                  <!-- must be include csrf field when we used post method, it's return a token -->

                  @csrf

                  <!-- Show the error messages -->

                  @include('backend.partials.messages')

                    <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
                
                     </div>
                  <div class="form-group">

                    <label for="description">Description(optional)</label>
                    <textarea name="description" class="form-control" placeholder="Enter Category Description Here...."></textarea>

                  </div>


                  <div class="form-group">
                    <label for="main_categories">Parent Category(optional)</label>
                      <select class="form-control" name="parent_id">

                    <option value="">Select A Parent Category</option>

                        @foreach($main_categories as $category)

              <option value="{{$category->id}}">{{$category->name}}</option>
                        
                        @endforeach

                      </select>
                    


                  </div>


                   <div class="form-group">

                    <label for="image">Category Image(optional)</label>

                    <!-- Adding Image -->
                        
                        <input type="file" class="form-control" id="image" name="image">      
                
                   </div>
                 
                  <button type="submit" class="btn btn-primary">Add Category</button>
            </form>

                

              </div>

            </div>


          </div>
            
      </div>

 <!-- main-panel ends -->

  @endsection