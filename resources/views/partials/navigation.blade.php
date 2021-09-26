<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{url('/')}}">Film Sales Service</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <form class="form-inline mr-auto">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <a href="{{session('cart')?url('/cart'):'#'}}"><i class="fa fa-shopping-cart" style="font-size:18px;color:rgb(202, 199, 199);"> {{session('cart')?count(session('cart')):'0'}}</i></a>
      <ul class="navbar-nav my-2 my-lg-0 ">

          @auth
          @if(Auth::user()->role->name == 'Admin')
          <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          @else
          <li class="nav-item">
              <a class="nav-link" href="{{url('profile')}}">Update Profile</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{url('purchases')}}">View Purchases</a>
          </li>
          @endif
          <li class="nav-item">

              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a class="nav-link" href="{{route('logout')}}"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      Log Out
                  </a>
              </form>

          </li>
          @else
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
          @endauth
      </ul>

    </div>
  </nav>
