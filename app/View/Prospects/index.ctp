<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
//echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="prospects index">
	<h2><?php echo __('Prospects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('business_name'); ?></th>
			<th><?php echo $this->Paginator->sort('Business ID'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('address2'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state_id'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($prospects as $prospect): ?>
	<tr>
		<td><?php echo h($prospect['Prospect']['id']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['business_name']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['business_id']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['address']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['address2']); ?>&nbsp;</td>
		<td><?php echo h($prospect['Prospect']['city']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($prospect['State']['short_name'], array('controller' => 'states', 'action' => 'view', $prospect['State']['id'])); ?>
		</td>

		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $prospect['Prospect']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $prospect['Prospect']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $prospect['Prospect']['id']), null, __('Are you sure you want to delete # %s?', $prospect['Prospect']['id'])); ?>
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

