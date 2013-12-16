<div class="frontProducts form">
<?php echo $this->Form->create('FrontProduct'); ?>
	<fieldset>
		<legend><?php echo __('Add Front Product'); ?></legend>
	<?php
		echo $this->Form->input('prospect_id');
		echo $this->Form->input('products');
		echo $this->Form->input('business');
		echo $this->Form->input('question');
		echo $this->Form->input('responseid');
		echo $this->Form->input('prospect_answer');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
