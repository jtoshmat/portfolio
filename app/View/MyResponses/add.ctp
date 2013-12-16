<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Response'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="responses form">
<?php echo $this->Form->create('Response'); ?>
	<fieldset>
		<legend><?php echo __('Add Response'); ?></legend>
	<?php
		echo $this->Form->input('response_text');
		echo $this->Form->input('user_id', array('disabled'=>true));
		$fullQ = array();
		foreach($questions as $q){
			$fullQ[$q['Question']['id']] = $q['Question']['question_text'];
		}
		echo $this->Form->input('question_id', array(
			'options'=> $fullQ
			));
		echo $this->Form->input('active');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>

