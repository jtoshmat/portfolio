<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New States'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="states view">
<h2><?php  echo __('State'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($state['State']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Abbreviation'); ?></dt>
		<dd>
			<?php echo h($state['State']['abbreviation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($state['State']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Footprint'); ?></dt>
		<dd>
			<?php echo h($state['State']['footprint']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($state['User']['id'], array('controller' => 'users', 'action' => 'view', $state['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($state['State']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($state['State']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Prospects'); ?></h3>
	<?php if (!empty($state['Prospect'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Email Address'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State Id'); ?></th>
		<th><?php echo __('Zipcode'); ?></th>
		<th><?php echo __('Phone Number'); ?></th>
		<th><?php echo __('Email Optin-in'); ?></th>
		<th><?php echo __('Language Id'); ?></th>
		<th><?php echo __('Origin Type Id'); ?></th>
		<th><?php echo __('Device Type Id'); ?></th>
		<th><?php echo __('Agent Facebook'); ?></th>
		<th><?php echo __('Global Nick'); ?></th>
		<th><?php echo __('Agent Email Address'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($state['Prospect'] as $prospect): ?>
		<tr>
			<td><?php echo $prospect['id']; ?></td>
			<td><?php echo $prospect['first_name']; ?></td>
			<td><?php echo $prospect['last_name']; ?></td>
			<td><?php echo $prospect['email_address']; ?></td>
			<td><?php echo $prospect['address']; ?></td>
			<td><?php echo $prospect['city']; ?></td>
			<td><?php echo $prospect['state_id']; ?></td>
			<td><?php echo $prospect['zipcode']; ?></td>
			<td><?php echo $prospect['phone_number']; ?></td>
			<td><?php echo $prospect['email_optin-in']; ?></td>
			<td><?php echo $prospect['language_id']; ?></td>
			<td><?php echo $prospect['origin_type_id']; ?></td>
			<td><?php echo $prospect['device_type_id']; ?></td>
			<td><?php echo $prospect['agent_facebook']; ?></td>
			<td><?php echo $prospect['global_nick']; ?></td>
			<td><?php echo $prospect['agent_email_address']; ?></td>
			<td><?php echo $prospect['created']; ?></td>
			<td><?php echo $prospect['modified']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
