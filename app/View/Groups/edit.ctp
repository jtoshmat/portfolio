<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="groups form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

