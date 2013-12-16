<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Answer Type'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="answerTypes form">
<?php echo $this->Form->create('AnswerType'); ?>
	<fieldset>
		<legend><?php echo __('Add Answer Type'); ?></legend>
	<?php
		echo $this->Form->input('common_name');
		echo $this->Form->input('type');
		echo $this->Form->input('description');
		echo $this->Form->input('user_id', array('disabled'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
