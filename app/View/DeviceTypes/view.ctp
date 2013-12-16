<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Device Type'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="deviceTypes view">
<h2><?php  echo __('Device Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($deviceType['DeviceType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Device Type Name'); ?></dt>
		<dd>
			<?php echo h($deviceType['DeviceType']['device_type_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($deviceType['DeviceType']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($deviceType['User']['id'], array('controller' => 'users', 'action' => 'view', $deviceType['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($deviceType['DeviceType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($deviceType['DeviceType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Prospects'); ?></h3>
	<?php if (!empty($deviceType['Prospect'])): ?>
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
		<th><?php echo __('Agent Facebook Id'); ?></th>
		<th><?php echo __('Global Nick'); ?></th>
		<th><?php echo __('Agent Email Address'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($deviceType['Prospect'] as $prospect): ?>
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
			<td><?php echo $prospect['agent_facebook_id']; ?></td>
			<td><?php echo $prospect['global_nick']; ?></td>
			<td><?php echo $prospect['agent_email_address']; ?></td>
			<td><?php echo $prospect['created']; ?></td>
			<td><?php echo $prospect['modified']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
