<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Paste Yuk! - @yield('title')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

  <!-- Styles -->
  {{-- <link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('css/bootstrap-purple.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
  <link href="{{ asset('css/pasteyuk.css') }}" rel="stylesheet">

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

  @yield('style')
  @yield('script')
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-purple navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Paste Yuk!</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/archive') }}">Archive</a>
          </li>
        </ul>

        <ul class="navbar-nav">
        @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ title_case(Auth::user()->username) }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
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
    </div>
  </nav>

  @yield('content')

  <footer class="text-muted">
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <p class="text-center">Made with <i class="fas fa-heart"></i> in Bekasi by <a href="https://github.com/realodix">realodix</a>.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
