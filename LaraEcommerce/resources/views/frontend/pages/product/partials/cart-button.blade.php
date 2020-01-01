<form class="form-inline" method="POST" action="{{ route('carts.store') }}">
	@csrf

<!-- As we use cart model in carts controller ,so we can access it's method also.
	For this reason we access product method and it's db field-->

<input type="hidden" name="product_id" value="{{ $product->id }}">

<button type="submit" class="btn btn-warning"><i class="fa fa-plus">Add TO Cart</i></button>


<!--<button type="button" class="btn btn-warning" onclick="addToCart({{$product->id}})" ><i class="fa fa-plus"></i> Add To Cart</button>-->



</form>