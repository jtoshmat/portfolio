<div class="prospects form">
<?php echo $this->Form->create('Prospect'); ?>
	<fieldset>
		<legend><?php echo __('Edit Prospect'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('email_address');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('state_id');
		echo $this->Form->input('zipcode');
		echo $this->Form->input('phone_number');
		echo $this->Form->input('email_optin-in');
		echo $this->Form->input('language_id');
		echo $this->Form->input('origin_type_id');
		echo $this->Form->input('device_type_id');
		echo $this->Form->input('agent_facebook');
		echo $this->Form->input('global_nick');
		echo $this->Form->input('agent_email_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Prospect.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Prospect.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Languages'), array('controller' => 'languages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Language'), array('controller' => 'languages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Origin Types'), array('controller' => 'origin_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Origin Type'), array('controller' => 'origin_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Device Types'), array('controller' => 'device_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device Type'), array('controller' => 'device_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospect Products'), array('controller' => 'prospect_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect Product'), array('controller' => 'prospect_products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospect Responses'), array('controller' => 'prospect_responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect Response'), array('controller' => 'prospect_responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
