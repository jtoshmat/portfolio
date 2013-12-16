<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Device Type'), array('action' => 'add')); ?></li>
		
	</ul></nav>
	<div class="deviceTypes form">
<?php echo $this->Form->create('DeviceType'); ?>
	<fieldset>
		<legend><?php echo __('Add Device Type'); ?></legend>
	<?php
		echo $this->Form->input('device_type_name');
		echo $this->Form->input('description');
		echo $this->Form->input('user_id', array('disabled'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
