<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="states view">
<h2><?php echo __('State'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($state['State']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($state['State']['short_name']); ?>
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
		<th><?php echo __('Business Name'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Address2'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State Id'); ?></th>
		<th><?php echo __('Zip Code'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Best Time To Call'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('Ip Address'); ?></th>
		<th><?php echo __('Ref'); ?></th>
		<th><?php echo __('Agent'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($state['Prospect'] as $prospect): ?>
		<tr>
			<td><?php echo $prospect['id']; ?></td>
			<td><?php echo $prospect['business_name']; ?></td>
			<td><?php echo $prospect['first_name']; ?></td>
			<td><?php echo $prospect['last_name']; ?></td>
			<td><?php echo $prospect['address']; ?></td>
			<td><?php echo $prospect['address2']; ?></td>
			<td><?php echo $prospect['city']; ?></td>
			<td><?php echo $prospect['state_id']; ?></td>
			<td><?php echo $prospect['zip_code']; ?></td>
			<td><?php echo $prospect['email']; ?></td>
			<td><?php echo $prospect['phone']; ?></td>
			<td><?php echo $prospect['best_time_to_call']; ?></td>
			<td><?php echo $prospect['website']; ?></td>
			<td><?php echo $prospect['ip_address']; ?></td>
			<td><?php echo $prospect['ref']; ?></td>
			<td><?php echo $prospect['agent']; ?></td>
			<td><?php echo $prospect['status']; ?></td>
			<td><?php echo $prospect['created']; ?></td>
			<td><?php echo $prospect['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'prospects', 'action' => 'view', $prospect['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'prospects', 'action' => 'edit', $prospect['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'prospects', 'action' => 'delete', $prospect['id']), null, __('Are you sure you want to delete # %s?', $prospect['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
