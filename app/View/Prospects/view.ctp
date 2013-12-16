<div class="prospects view">
<h2><?php  echo __('Prospect'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Address'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['email_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospect['State']['id'], array('controller' => 'states', 'action' => 'view', $prospect['State']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zipcode'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['zipcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone Number'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['phone_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Optin-in'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['email_optin-in']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospect['Language']['id'], array('controller' => 'languages', 'action' => 'view', $prospect['Language']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Origin Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospect['OriginType']['id'], array('controller' => 'origin_types', 'action' => 'view', $prospect['OriginType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Device Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospect['DeviceType']['id'], array('controller' => 'device_types', 'action' => 'view', $prospect['DeviceType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agent Facebook'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['agent_facebook']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Global Nick'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['global_nick']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agent Email Address'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['agent_email_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prospect'), array('action' => 'edit', $prospect['Prospect']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prospect'), array('action' => 'delete', $prospect['Prospect']['id']), null, __('Are you sure you want to delete # %s?', $prospect['Prospect']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Prospect Products'); ?></h3>
	<?php if (!empty($prospect['ProspectProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Prospect Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($prospect['ProspectProduct'] as $prospectProduct): ?>
		<tr>
			<td><?php echo $prospectProduct['id']; ?></td>
			<td><?php echo $prospectProduct['product_id']; ?></td>
			<td><?php echo $prospectProduct['prospect_id']; ?></td>
			<td><?php echo $prospectProduct['created']; ?></td>
			<td><?php echo $prospectProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'prospect_products', 'action' => 'view', $prospectProduct['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'prospect_products', 'action' => 'edit', $prospectProduct['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'prospect_products', 'action' => 'delete', $prospectProduct['id']), null, __('Are you sure you want to delete # %s?', $prospectProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Prospect Product'), array('controller' => 'prospect_products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Prospect Responses'); ?></h3>
	<?php if (!empty($prospect['ProspectResponse'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Response Value'); ?></th>
		<th><?php echo __('Prospect Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($prospect['ProspectResponse'] as $prospectResponse): ?>
		<tr>
			<td><?php echo $prospectResponse['id']; ?></td>
			<td><?php echo $prospectResponse['response_value']; ?></td>
			<td><?php echo $prospectResponse['prospect_id']; ?></td>
			<td><?php echo $prospectResponse['question_id']; ?></td>
			<td><?php echo $prospectResponse['created']; ?></td>
			<td><?php echo $prospectResponse['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'prospect_responses', 'action' => 'view', $prospectResponse['prospect_response_id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'prospect_responses', 'action' => 'edit', $prospectResponse['prospect_response_id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'prospect_responses', 'action' => 'delete', $prospectResponse['prospect_response_id']), null, __('Are you sure you want to delete # %s?', $prospectResponse['prospect_response_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Prospect Response'), array('controller' => 'prospect_responses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
