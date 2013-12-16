<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('short_name');
		echo $this->Form->input('long_name');
		echo $this->Form->input('description');
		echo $this->Form->input('brochure_link');
		echo $this->Form->input('user_id',array('disabled'=>true));
		echo $this->Form->input('active');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

