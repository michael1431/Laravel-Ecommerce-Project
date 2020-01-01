<!DOCTYPE html>
<html>
<head>
	<title>
		
	@yield('title', 'Laravel Ecommerce Project')

	</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

  @include('frontend.partials.style')
  
</head>
<body>

 <div class="wrapper">


  @include('frontend.partials.nav')

  @include('frontend.partials.messages')

  @yield('content')

  @include('frontend.partials.footer')



	
 	
 </div>

@include('frontend.partials.scripts')
@yield('scripts')


</body>
</html>