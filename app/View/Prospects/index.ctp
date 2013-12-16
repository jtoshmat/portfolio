<div class="prospects index">
	<h2><?php echo __('Prospects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('email_address'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state_id'); ?></th>
			<th><?php echo $this->Paginator->sort('zipcode'); ?></th>
			<th><?php echo $this->Paginator->sort('phone_number'); ?></th>
			<th><?php echo $this->Paginator->sort('email_optin-in'); ?></th>
			<th><?php echo $this->Paginator->sort('language_id'); ?></th>
			<th><?php echo $this->Paginator->sort('origin_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('device_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('agent_facebook'); ?></th>
			<th><?php echo $this->Paginator->sort('global_nick'); ?></th>
			<th><?php echo $this->Paginator->sort('agent_email_address'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($prospects as $prospect): ?>
	<tr>
		<td><?php echo h($prospect['Prospect']['id']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['status']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['email_address']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['address']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['city']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($prospect['State']['id'], array('controller' => 'states', 'action' => 'view', $prospect['State']['id'])); ?>
		</td>
		<td><?php echo h($prospect['Prospect']['zipcode']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['phone_number']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['email_optin-in']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($prospect['Language']['id'], array('controller' => 'languages', 'action' => 'view', $prospect['Language']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($prospect['OriginType']['id'], array('controller' => 'origin_types', 'action' => 'view', $prospect['OriginType']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($prospect['DeviceType']['id'], array('controller' => 'device_types', 'action' => 'view', $prospect['DeviceType']['id'])); ?>
		</td>
		<td><?php echo h($prospect['Prospect']['agent_facebook']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['global_nick']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['agent_email_address']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['created']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $prospect['Prospect']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $prospect['Prospect']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $prospect['Prospect']['id']), null, __('Are you sure you want to delete # %s?', $prospect['Prospect']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Prospect'), array('action' => 'add')); ?></li>
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
