<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
 <script src="{{ asset('js/popper.min.js') }}"></script>
 <script src="{{ asset('js/bootstrap.min.js') }}"></script>


 <!--
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

 jquery for add to cart 

 <script>

	 $.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
 	
 	function addToCart(product_id){

 	var url = "{{ url('/')}}";

 		$.post( url+"/api/carts/store",
 		 { 
 		 	product_id:product_id
 		  })
	    .done(function( data ) {

	    data = JSON.parse(data);

	    if(data.status == 'success'){

	    	// show the toast. i download this from alertifyjs.com->notifier->position

	    	alertify.set('notifier','position', 'top-center');
 			alertify.success('Item added to cart Successfully!! Total Items:'+data.totalItems+ '<br> To checkout <a href="{{ route('carts') }}">go to checkout page</a>');

	    	$("#totalItems").html(data.totalItems);
	    }
	  });
 	}
 

 </script>-->