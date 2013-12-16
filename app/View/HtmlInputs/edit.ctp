<div class="htmlInputs form">
<?php echo $this->Form->create('HtmlInput'); ?>
	<fieldset>
		<legend><?php echo __('Edit Html Input'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('short_name');
		echo $this->Form->input('user_id');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('HtmlInput.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('HtmlInput.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Html Inputs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
