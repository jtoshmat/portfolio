<?php
$cont = $this->params['controller'];
$act = $this->params['action'];
if (!$is_user_loggedin && $controller!=$cont && $act!=$action){
	echo "You are not authorized to display this page";
	header('Location: users/login');
	exit("You are not authorized to display this page");
}
?>