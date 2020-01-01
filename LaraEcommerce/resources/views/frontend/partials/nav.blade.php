
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">

    <div class="container">

    <a class="navbar-brand" href="{{ route('index') }}">

      <img src="{{ asset('images/logo2.png')}}" height="40" width="70">

    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item {{Route::is('index') ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item {{Route::is('products') ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('products') }}">Products</a>
    </li>

    <li class="nav-item {{Route::is('contact') ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
    </li>


    <li class="nav-item">

    <form class="form-inline my-2 my-lg-0" action="{{route('search')}}" method="get">

    <div class="input-group mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search Products" aria-label="Recipient's username" aria-describedby="button-addon2">
    <div class="input-group-append">
    <button class="btn btn-outline-secondary search-icon-button" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
    </div>
    </div>

    </form>

    </li>
    </ul>


    <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">

          <li class="nav-item">
                  <a class="nav-link" href="{{ route('carts') }}">
                    
                    <button class="btn btn-danger">
                      <span class="mt-1">Cart</span>
                      <span class="badge badge-warning" id="totalItems">
                        {{ App\Models\Cart::totalItems() }}
                      </span>
                    </button>

                  </a>
           </li>

          <!-- Authentication Links -->
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      <img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" class="img rounded-circle" style="width: 40px">
                      {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                   
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                     <a class="dropdown-item" href="{{ route('user.dashboard') }}"}}>
                        My Dashboard
                     </a>
                      <a class="dropdown-item" href="{{ route('user.logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
      </ul>


    <!--<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Something else here</a>
    </div>
    </li>
    <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </li>-->





    </div>
    </div>
    </nav>