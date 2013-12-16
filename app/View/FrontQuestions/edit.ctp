<div class="frontQuestions form">
<?php echo $this->Form->create('FrontQuestion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Front Question'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Business');
		echo $this->Form->input('Question');
		echo $this->Form->input('Response');
		echo $this->Form->input('business_id');
		echo $this->Form->input('question_id');
		echo $this->Form->input('response_id');
		echo $this->Form->input('products');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FrontQuestion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FrontQuestion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Front Questions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Business Questions'), array('controller' => 'business_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Question'), array('controller' => 'business_questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
