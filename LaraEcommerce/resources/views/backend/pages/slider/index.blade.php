 @extends('backend.layouts.master')

 @section('content')

 <div class="main-panel">

        <div class="content-wrapper">
        

            <div class="card">

              <div class="card-header">

                Manage Sliders
                
              </div>


              <div class="card-body">

                  @include('backend.partials.messages')

                  <!-- code for add slider -->

                  <a href="#addSliderModal" data-toggle="modal" class="btn btn-info float-right mb-2">
                    <i class="fa fa-plus"></i>Add New Slider
                  </a>
                  <div class="clearfix"></div>


                 <div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              
                              <form action="{!! route('admin.slider.store') !!}" method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <!-- form of add slider -->

                                <div class="form-group">

                                  <label for="title">Slider Title <small class="text-danger">(required)</small></label>
                                  <input type="text" name="title" id="title" class="form-control" placeholder="Slider Title" required="">

                                  </div>

                                   <div class="form-group">

                                  <label for="image">Slider image <small class="text-danger">(required)</small></label>
                                  <input type="file" name="image" id="image" class="form-control" placeholder="Slider image" required="">

                                  </div>

                                   <div class="form-group">

                                  <label for="button_text">Slider Button Text <small class="text-danger">(optional)</small></label>
                                  <input type="text" name="button_text" id="button_text" class="form-control" placeholder="Slider Button Text">

                                  </div>

                                  <div class="form-group">

                                  <label for="button_link">Slider Button Link <small class="text-danger">(optional)</small></label>
                                  <input type="url" name="button_link" id="button_link" class="form-control" placeholder="Slider Button Link">

                                  </div>

                                  <div class="form-group">

                                  <label for="priority">Slider priority <small class="text-danger">(required)</small></label>
                                  <input type="number" name="priority" id="priority" class="form-control" placeholder="Slider Priority; e.g. 10 "  value="10" required="">

                                  </div>


                                   <button type="submit" class="btn btn-success">Add New Slider</button>

                                   <button type="submit" class="btn btn-secondary" data-dismiss ="modal">Cancel Slider</button>
                              
                              </form>

                            </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>





                <table class="table table-bordered table-hover">
                  
                    <tr>

                      <th>#</th>
                      <th>Slider Title</th>
                      <th>Slider Image</th>
                      <th>Slider Priority</th>
                      <th>Action</th>

                    </tr>

                   <!--Show all the slider description -->

                 

                   @foreach($sliders as $slider)

                   <tr>

                     
                     <td>{{ $loop->index + 1 }}</td>
                     <td>{{ $slider->title }}</td>
                     
                     <td>

                      <img src="{{ asset('images/sliders/'.$slider->image)}}" width="40">

                     </td>

                     <td>{{ $slider->priority }}</td>

                     <td>
                  
                      <a href="#editModal{{ $slider->id }}" data-toggle="modal" class="btn btn-success">Edit</a>

                      <a href="#deleteModal{{ $slider->id }}" data-toggle="modal" class="btn btn-danger">Delete</a>

                      <!-- Delete Modal -->

                        <div class="modal fade" id="deleteModal{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete??</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>


                              <div class="modal-body">
                                
                                <form action="{!! route('admin.slider.delete',$slider->id) !!}" method="post">

                                  {{ csrf_field() }}

                                     <button type="submit" class="btn btn-danger">Permanent Delete</button>
                                  


                                </form>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>


                         <!-- Edit Modal -->

                        <div class="modal fade" id="editModal{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Edit??</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <div class="modal-body">
                              
                              <form action="{!! route('admin.slider.update',$slider->id) !!}" method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <!-- form of add slider -->

                                <div class="form-group">

                                  <label for="title">Slider Title <small class="text-danger">(required)</small></label>
                                  <input type="text" name="title" id="title" class="form-control" placeholder="Slider Title" required="" value="{{ $slider->title }}">

                                  </div>

                                   <div class="form-group">

                                  <label for="image">Slider image 

                                    <a href="{{ asset('images/sliders/'.$slider->image)}}" target="_blank">Previous Image</a>

                              <small class="text-danger">(required)</small></label>
                                  <input type="file" name="image" id="image" class="form-control" placeholder="Slider image">

                                  </div>

                                   <div class="form-group">

                                  <label for="button_text">Slider Button Text <small class="text-danger">(optional)</small></label>
                                  <input type="text" name="button_text" id="button_text" class="form-control" placeholder="Slider Button Text" value="{{ $slider->button_text }}">

                                  </div>

                                  <div class="form-group">

                                  <label for="button_link">Slider Button Link <small class="text-danger">(optional)</small></label>
                                  <input type="url" name="button_link" id="button_link" class="form-control" placeholder="Slider Button Link" value="{{ $slider->button_link }}">

                                  </div>

                                  <div class="form-group">

                                  <label for="priority">Slider priority <small class="text-danger">(required)</small></label>
                                  <input type="number" name="priority" id="priority" class="form-control" placeholder="Slider Priority; e.g. 10 "  value="{{ $slider->priority }}" required="" >

                                  </div>


                                   <button type="submit" class="btn btn-success"> Update Slider</button>

                                   <button type="submit" class="btn btn-secondary" data-dismiss ="modal">Cancel Slider</button>
                              
                              </form>

                            </div>
                           
                            </div>
                          </div>
                        </div>

                    </td>

                   </tr>

                  

                   @endforeach

                </table>

                

              </div>

            </div>


          </div>
            
      </div>

 <!-- main-panel ends -->

  @endsection