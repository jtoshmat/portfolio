@section("header")
<header class="navbar navbar-inverse navbar-static-top main-header" id="top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand">Packers Everywhere</a>
    </div>
    <nav id="main-navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
      @if (Auth::check())
      	<li>
	        <a href="http://www.packerseverywhere.com/app" target="_blank">View App</a>
      	</li>
      	<li>
	        <a href="{{ URL::route("user/logout") }}">Log Out</a>
      	</li>
      @else
        <li>
          <a href="{{ URL::route("user/login") }}">Member Login</a>
        </li>
        <li>
          <a href="{{ URL::route("register") }}">New Registration</a>
        </li>
      @endif
      </ul>
    </nav>
  </div>
</header>
@if (Auth::check())
<div class="container">
  <ul class="nav nav-tabs">
    <li role="presentation" class="active"><a href="{{ URL::route("bars") }}">Bar Index</a></li>
    <li role="presentation"><a href="#">Season Schedule</a></li>
  </ul>
</div>
@endif
@show
