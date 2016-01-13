<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<?php
//Declare form vars
	$username = isset($_POST['username'])?$_POST['username']:null;
	$password = isset($_POST['password'])?$_POST['password']:null;
	$username = filter_var($username, FILTER_SANITIZE_STRING);
	$password = filter_var($password, FILTER_SANITIZE_STRING);
	$isFormPosted = isset($_POST['submit'])?true:false;
	$isFormActive = ($username && $password)?true:false;



	if ($isFormActive){
		//This is usually executed on controller
		//Pass the vals to model
		echo "Please wait while login is in process";
	}

	if ($isFormPosted && !$isFormActive){
		echo "The required fields are not entered";
	}

?>


<div class="wrapper">
	<form class="form-signin" method="post" action="login.php"
		<h2 class="form-signin-heading">Please login</h2>
		<input type="text" =""="" required="" placeholder="Email Address" name="username" class="form-control">
		<input type="password" required="" placeholder="Password" name="password" class="form-control">
		<label class="checkbox">
			<input type="checkbox" name="rememberMe" id="rememberMe" value="remember-me"> Remember me
		</label>
		<button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Login</button>
	</form>
</div>


</body>
</html>