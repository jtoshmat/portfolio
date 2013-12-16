<!DOCTYPE HTML>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php echo $this->Html->script('jquery.min'); // Include jQuery library?>
	<?php echo $this->Html->script('admin'); // Include jQuery library?>
	<?php echo $this->Html->charset(); ?>
	<title>
 		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('admin');
		//echo $this->fetch('meta');
		//echo $this->fetch('css');
	?>



</head>
<body>
	<div id="container">
		<div id="header">
		<div class="title">
		<?php
		if ($is_user_loggedin){
		echo "<h1>Admin Panel</h1>";
		}else{
	echo "<h1>Welcome to CNA!</h1>";
	}
		?>

		</div>
	<?php
	$group_name = null;

	$curr_view = $this->params['controller'];
	$curr_action = $this->action;

if ($this->params['controller']!='users' && $this->action!='login'){

if ($is_user_loggedin){
	$group = $this->requestAction('groups/getgroup/'.$current_user['group_id']);
	$group_name = $group['Group']['name'];
		echo "<div class='current_user'>";
		echo "<h4>Welcome ".$this->Html->link($current_user['username'],array('controller'=>'users','action'=>'profile',$current_user['id']))."(".$group_name.") | ". $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'))."</h4>";
		echo "</div>";

}else{
echo "<div class='current_user'>";
	echo $this->Html->link('Login',array('controller'=>'users','action'=>'login'));
echo "</div>";
}

}


if (isset($current_user['group_id']) && $current_user['group_id']==1){
echo $this->element("admin_menu");
}elseif (isset($current_user['group_id']) && $current_user['group_id']==2){
echo $this->element("sta_menu");
}
elseif (isset($current_user['group_id']) && $current_user['group_id']==3){
echo $this->element("report_menu");
}
?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>

				<footer>
			<div id="footer">
				<small role="contentinfo">
					<p class="copyright"> &copy; 2012 - 2013 American Family Insurance. All Rights Reserved.</p>
					<p class="links">
					<a href="http://www.amfam.com/security/identification.asp" class="external" target="_blank">Company Information</a> |
					<a href="http://www.amfam.com/security/privacy.asp" class="external" target="_blank">Privacy and Security Policy</a> |
					<a href="http://www.amfam.com/security/legal.asp" class="external" target="_blank">Legal Notice</a>
					</p>
					<p class="call">Call us anytime at 1-800-MYAMFAM <span>(1-800-692-6326)</span></p>
				</small>
			</div>
		</footer>


	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
