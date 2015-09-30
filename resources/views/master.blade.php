<html>
<head>
	@section('head')
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" media="screen" type="text/css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	@show
</head>
<body>
<br/>
    <a href="/auth/login">Login</a> |
    <a href="/auth/register">Register</a> |
    <a href="/users/members">Members</a> |
    <a href="/auth/logout">Logout</a> |
<div class="container">
	@yield('content')
</div>
@section('footer_scripts')
	<script src="http://code.jquery.com/jquery.js"></script>
    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@show
</body>
</html>