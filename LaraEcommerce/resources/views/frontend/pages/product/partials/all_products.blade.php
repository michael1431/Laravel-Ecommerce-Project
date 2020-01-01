
					<div class="row">
            <!-- code for show all products -->

            @foreach($products as $product)

						<div class="col-md-4">

							<div class="card">
			<!-- same product id just akta image anbe, multiple takle show korbe na duita,akta show korbe -->

                @php $i = 1; @endphp

                  <!-- code for show images -->
                    @foreach($product->images as $image)

                    @if($i> 0)
                  <!-- just show an image once for one product id -->

                    <a href="{{route('products.show',$product->slug)}}"><img class="card-img-top feature-img" src="{{ asset('images/products/'.$image->image) }}" alt="{{$product->title}}"></a>
                    @endif

                    @php $i--; @endphp

                    @endforeach
                               <div class="card-body">
                               <h4 class="card-title">
                               	<!-- product model e dukhe title k print korbe -->

                                 <!-- title e click korle ai route e niye jabe-->
                              <a href="{{route('products.show',$product->slug)}}">{{$product->title}}</a>

                               </h4>
                               <p class="card-text">Taka: {{$product->price}}</p>

                             @include('frontend.pages.product.partials.cart-button')
                             
                               </div>
                </div>
							
						</div>

            @endforeach

						
					</div>

          <!-- code for pagination -->

          <div class="mt-4 pagination">
            {{ $products->links()}}
          </div>