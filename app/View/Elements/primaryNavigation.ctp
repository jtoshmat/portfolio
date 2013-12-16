<nav>
	<ul>
		<?php 

		if($this->Session->read('Auth.User')){
			$group = $this->Session->read('Auth.User.group_id'); 
			
		} else {
			$group = null;
		}
		
		if($group == 1){
		?>
		<li><?php echo $this->Html->link(__('Users'), array('controller'=>'users','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Answer Types'), array('controller' => 'answer_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Device Types'), array('controller' => 'device_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		
		<li><?php echo $this->Html->link(__('Origin Types'), array('controller' => 'origin_types', 'action' => 'index')); ?> </li>

		<?php } 
		if($group == 2 || $group == 1) {  ?>

		<li><?php echo $this->Html->link(__('Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<?php } ?>
		
		
		<!-- <li><?php //echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Answer Type'), array('controller' => 'answer_types', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Device Type'), array('controller' => 'device_types', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Login Entry'), array('controller' => 'login_entries', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Origin Type'), array('controller' => 'origin_types', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		
		<li><?php //echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li> -->

		<?php if($this->Session->read('Auth.User')){ ?>
		<li><?php echo $this->Html->link(__('Logout'), array('controller'=>'users', 'action' => 'logout')); ?></li>
		<?php } else { ?>
		<li><?php echo $this->Html->link(__('Login'), array('controller'=>'users', 'action' => 'login')); ?></li>
		<?php } ?>
	</ul>
</nav>
