<div class="prospectProducts form">
<?php echo $this->Form->create('ProspectProduct'); ?>
	<fieldset>
		<legend><?php echo __('Add Prospect Product'); ?></legend>
	<?php
		echo $this->Form->input('product_id');
		echo $this->Form->input('prospect_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Prospect Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
	</ul>
</div>
