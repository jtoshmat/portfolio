<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New States'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="states form">
<?php echo $this->Form->create('State'); ?>
	<fieldset>
		<legend><?php echo __('Add State'); ?></legend>
	<?php
		echo $this->Form->input('abbreviation');
		echo $this->Form->input('full_name');
		echo $this->Form->input('footprint');
		echo $this->Form->input('user_id',array('disabled'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

