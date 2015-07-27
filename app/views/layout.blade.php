<!DOCTYPE html>
<html lang=”en”>
  <head>
    <meta charset="UTF-8" />
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css" />
    <script src='/js/jquery-git2.min.js'></script>
    <script src='/js/jquery.dataTables.min.js'></script>
    <script src='/js/main.js'></script>
    <title>Packers Everywhere</title>
  </head>
  <body>
    @include("header")



    <div class="content">
      <div class="container">
        @yield("content")
      </div>
    </div>
    @include("footer")
  </body>
</html>
