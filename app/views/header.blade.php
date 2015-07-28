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
<<<<<<< HEAD
        <a href="{{ URL::route("user/logout") }}">
          logout
        </a> |
        <a href="{{ URL::route("bars") }}">
          bars
        </a>
=======
        <li>
          <a href="{{ URL::route("user/profile") }}">Profile</a>
        </li>
        <li>
          <a href="{{ URL::route("user/logout") }}">Log Out</a>
        </li>
        <li>
          <a href="{{ URL::route("user/users") }}">Users</a>
        </li>
>>>>>>> fe-task-runners

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

@show
