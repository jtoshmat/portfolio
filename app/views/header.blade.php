@section("header")
  <div class="header">
    
<div class="container">

<div  class="table-responsive page-header">
    <table class="table  display nowrap  dtr-inline">
      <tr><td>
  <h1>Packers Everywhere</h1>
  <p>We help you find Packers near you.</p>
 
    <hr />
 
      @if (Auth::check())
        <a href="{{ URL::route("user/logout") }}">
          logout
        </a> |
        <a href="{{ URL::route("user/profile") }}">
          profile
        </a>

         |
        <a href="{{ URL::route("user/users") }}">
          Users
        </a>
      @else
        <a href="{{ URL::route("user/login") }}">
          login
        </a>
      @endif
    </td>
  </tr>
    </table>
    </div>
 
@show
