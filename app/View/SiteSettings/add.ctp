<div class="siteSettings form">
<?php echo $this->Form->create('SiteSetting'); ?>
	<fieldset>
		<legend><?php echo __('Add Site Setting'); ?></legend>
	<?php
		echo $this->Form->input('short_name');
		echo $this->Form->input('value1');
		echo $this->Form->input('value2');
		echo $this->Form->input('value3');
		echo $this->Form->input('value4');
		echo $this->Form->input('user_id');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Site Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
