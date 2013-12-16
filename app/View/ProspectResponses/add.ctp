<div class="prospectResponses form">
<?php echo $this->Form->create('ProspectResponse'); ?>
	<fieldset>
		<legend><?php echo __('Add Prospect Response'); ?></legend>
	<?php
		
		echo $this->Form->input('response_value');
		echo $this->Form->input('prospect_id');
		echo $this->Form->input('question_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Prospect Responses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
