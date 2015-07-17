<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Packers Authentication</title>
     {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') }}
    {{ HTML::style('css/style.css')}}
  </head>
 
  <body>
 
   <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav2"> 
                    <li>{{ HTML::link('register', 'Register') }}</li>  
                    <li>{{ HTML::link('login', 'Login') }}</li>  
                    <li>{{ HTML::link('profile', 'Profile') }}</li>  
                    <li>{{ HTML::link('logout', 'Logout') }}</li>  
                    <br /> <br />
                </ul> 
            </div>
        </div>
    </div>
             
 
    <div class="container">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
 
        @yield('content')
    </div>


  </body>
</html>

        
 