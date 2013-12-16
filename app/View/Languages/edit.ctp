<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Language'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="languages form">
<?php echo $this->Form->create('Language'); ?>
	<fieldset>
		<legend><?php echo __('Edit Language'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('short_name');
		echo $this->Form->input('long_name');
		echo $this->Form->hidden('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

