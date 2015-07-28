<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/css/main.css" />
    <title>Packers Everywhere</title>
  </head>
  <body>
    @include("header")



    <div id="main-content" class="content">
      @yield("content")
    </div>
    @include("footer")
    <script src='/js/vendor/jquery-1.11.3.min.js'></script>
    <script src='/js/vendor/jquery.dataTables.min.js'></script>
    <script src='/js/vendor/bootstrap.min.js'></script>
    <script src='/js/main.js'></script>
  </body>
</html>
