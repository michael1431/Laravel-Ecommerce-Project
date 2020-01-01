
@extends('frontend.layouts.master')
@section('content')

<!-- Start Sidebar + Content -->
<div class="container margin-top-20">

	<div class="row">
		
		<div class="col-md-4">
			
	    <div class="list-group">
  
       @include('frontend.partials.product-sidebar')
  
        </div>
		</div>

		<div class="col-md-8">


			<div class="widget">
				<!-- ai categoryr under e sob product show korabo -->
				
				<h3>All Products in <span class="badge badge-success">{{$category->name }} Category</span></h3>

				<!-- jehetu all products page e products name akta object ache
					so amader oi same name e akta variable nite hobe otherwise
					error show korbe-->

			<!-- category object diye category class er method access kortechi -->

				@php
				 $products = $category->products()->paginate(9) ;
				 @endphp
			<!-- then ai products variable ta all products page e jabe-->

			@if( $products->count() >0)
				@include('frontend.pages.product.partials.all_products')
		     @else
		     <div class="alert alert-warning">
		     	No Product has added in this  category yet!!
		     </div>
		     @endif

		



			</div>



			<div class="widget" style="margin-bottom: 80px">
				


			</div>
			
		</div>


	</div>


</div>


<!-- End Sidebar + Content -->
@endsection

