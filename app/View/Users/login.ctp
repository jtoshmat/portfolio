<h2>Login</h2>
<?php 
	// $dbc = new DATABASE_CONFIG;
	// $default1 = $dbc->default;
	// echo $dbc->getServer();
	// echo "<hr />";
	// var_dump($dbc->environment());
	// echo "<hr />";
	 ?>
	
	<?php //var_dump($default1); ?>
<?php echo $this->Session->flash('auth'); ?>
<div class="login forms">
	<?php 
	echo $this->Form->create('User', array('url' => array('controller'=>'users','action'=>'login')));
	echo $this->Form->input('User.username');
	echo $this->Form->input('User.password');
	echo $this->Form->end('Login');
	?>
</div>