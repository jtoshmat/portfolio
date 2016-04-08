<!DOCTYPE html>
<html>
<head>
    <title>Caretraxx - @yield('title')</title>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
@section('sidebar')
@show
<div class="container">
    @yield('content')
</div>
</body>
</html>