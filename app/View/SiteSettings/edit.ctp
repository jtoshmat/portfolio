<div class="siteSettings form">
<?php echo $this->Form->create('SiteSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Site Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('short_name');
		echo $this->Form->input('value1');
		echo $this->Form->input('value2');
		echo $this->Form->input('value3');
		echo $this->Form->input('value4');
		echo $this->Form->input('user_id');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SiteSetting.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SiteSetting.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Site Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
