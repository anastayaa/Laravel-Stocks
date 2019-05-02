<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel 5.7 CRUD Example</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <style>
	  .nav {
	    margin-top: 40px;
	  }
  </style>
</head>
<body>
  <div class="container">
  	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link active" href="{{ route('shares.index')}}">Stocks</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="{{ route('shares.create')}}">New Stock</a>
	  </li>
    <li class="nav-item">
      <a class="nav-link active" href="{{ route('logout') }}"
         onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
	</ul>
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>