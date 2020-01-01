 @extends('backend.layouts.master')

 @section('content')

 <div class="main-panel">

        <div class="content-wrapper">
        

            <div class="card">

              <div class="card-header">

                Edit Category
                
              </div>


              <div class="card-body">

                 <form action="{{ route('admin.category.update',$category->id) }}" method="post" enctype="multipart/form-data">

                  <!-- must be include csrf field when we used post method, it's return a token -->

                  @csrf

                  <!-- Show the error messages -->

                  @include('backend.partials.messages')

                    <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                
                     </div>
                  <div class="form-group">

                    <label for="description">Description(Optional)</label>
                    <textarea name="description" class="form-control"> {{ $category->description }} </textarea>

                  </div>


                  <div class="form-group">
                    
              <label for="main_categories">Parent Category(Optional)</label>

                      <select class="form-control" name="parent_id">

                        <option value="">Select a Primary Category</option>

                        @foreach($main_categories as $cat)

              <option value="{{$cat->id}}" {{ $cat->id == $category->parent_id ? 'selected' : ''}}> {{$cat->name}} </option>
                        
                        @endforeach

                      </select>
                    


                  </div>


                   <div class="form-group">

                    <label for="old image">Category Old Image</label><br>

                     <img src="{{asset('images/categories/'.$category->image)}}" width="100"><br>

                 <label for="new image">Category New Image(Optional)</label>

                        <input type="file" class="form-control" id="image" name="image">      
                
                   </div>
                 
                  <button type="submit" class="btn btn-primary">Update Category</button>
            </form>

                

              </div>

            </div>


          </div>
            
      </div>

 <!-- main-panel ends -->

  @endsection