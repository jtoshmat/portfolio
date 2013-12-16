<div class="prospectProducts index">
	<h2><?php echo __('Prospect Products'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('prospect_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($prospectProducts as $prospectProduct): ?>
	<tr>
		<td><?php echo h($prospectProduct['ProspectProduct']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($prospectProduct['Product']['id'], array('controller' => 'products', 'action' => 'view', $prospectProduct['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($prospectProduct['Prospect']['id'], array('controller' => 'prospects', 'action' => 'view', $prospectProduct['Prospect']['id'])); ?>
		</td>
		<td><?php echo h($prospectProduct['ProspectProduct']['created']); ?>&nbsp;</td>
		<td><?php echo h($prospectProduct['ProspectProduct']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $prospectProduct['ProspectProduct']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $prospectProduct['ProspectProduct']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $prospectProduct['ProspectProduct']['id']), null, __('Are you sure you want to delete # %s?', $prospectProduct['ProspectProduct']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Prospect Product'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
	</ul>
</div>
