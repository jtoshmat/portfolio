<?php
$user = $this->requestAction('users/profile/'.$current_user['id']);
?>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php


		echo $this->Form->input('id');
		echo $this->Form->input('username',array('value'=>$user['User']['username'],'placeholder' => '','div' =>'' ));
		echo $this->Form->input('password',array('value'=>$user['User']['password'],'placeholder' => '','div' =>'' ));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>