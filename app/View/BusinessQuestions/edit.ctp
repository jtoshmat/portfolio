<div class="businessQuestions form">
<?php echo $this->Form->create('BusinessQuestion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Business Question'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('business_id');
		echo $this->Form->input('question_id');
		echo $this->Form->input('response_id');
		//echo $this->Form->input('response_id'). $this->Html->link("Responses List", array('controller' => 'responses', 'action' => 'index'));



		$pid = explode(';',$businessquestions['BusinessQuestion']['products']);
		echo $this->Form->input('products', array('type'=>'select','multiple' => true, 'selected' => $pid,'empty'=>'Select'));
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
