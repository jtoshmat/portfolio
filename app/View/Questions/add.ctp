<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="questions form">
<?php echo $this->Form->create('Question'); ?>
	<fieldset>
		<legend><?php echo __('Add Question'); ?></legend>
	<?php
		echo $this->Form->input('question_text');
		echo $this->Form->input('user_id', array('disabled'=> true));
		$productNames = array();
		foreach($products as $p){
			$productNames[$p['Product']['id']] = $p['Product']['long_name'];
		}

		echo $this->Form->input('product_id', array(
			'options'=>$productNames
		));
		$commonNames = array();
		foreach($answerTypes as $a){
			$commonNames[$a['AnswerType']['id']] = $a['AnswerType']['common_name'];
		}
		
		echo $this->Form->input('answer_type_id', array(
			'options'=> $commonNames
			));
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>
