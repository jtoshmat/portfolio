<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/css/main.css" />
    <title>Packers Everywhere</title>
  </head>
  <body>
    @include("header")

     @if(session::has('mymessage'))
     @if(!empty(session::get('mymessage')))
         <div class="alert alert-success">{{session::get('mymessage')}}</div>
      @endif
      @endif

    <div class="content">
      <div class="container">
        @yield("content")
      </div>
    </div>
    @include("footer")
    <script src='/js/vendor/jquery-1.11.3.min.js'></script>
    <script src='/js/vendor/jquery.dataTables.min.js'></script>
    <script src='/js/vendor/bootstrap.min.js'></script>
    <script src='/js/main.js'></script>
  </body>
</html>
