<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('home') }}">Wishlist</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            @if (auth()->check())
            <li class="{{ request()->is('wishlist/my') ? 'active' : '' }}"><a href="{{ route('my_wishlist') }}">My wishlist</a></li>
            <li class="{{ request()->is('wishlist/search') ? 'active' : '' }}"><a href="{{ route('search_repo') }}">Search libraries.io</a></li>
            <li class="{{ request()->is('profile') ? 'active' : '' }}"><a href="{{ route('profile') }}">My profile</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
            @else
            <li class="{{ request()->is('login') ? 'active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
            <li class="{{ request()->is('register') ? 'active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>