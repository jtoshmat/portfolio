<div class="frontProducts index">
	<h2><?php echo __('Front Products'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('prospect_id'); ?></th>
			<th><?php echo $this->Paginator->sort('products'); ?></th>
			<th><?php echo $this->Paginator->sort('business'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th><?php echo $this->Paginator->sort('responseid'); ?></th>
			<th><?php echo $this->Paginator->sort('prospect_answer'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($frontProducts as $frontProduct): ?>
	<tr>
		<td><?php echo h($frontProduct['FrontProduct']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($frontProduct['Prospect']['first_name']." ".$frontProduct['Prospect']['last_name'], array('controller' => 'prospects', 'action' => 'view', $frontProduct['Prospect']['id'])); ?>
		</td>
		<td><?php echo h($frontProduct['FrontProduct']['products']); ?>&nbsp;</td>
		<td><?php echo h($frontProduct['FrontProduct']['business']); ?>&nbsp;</td>
		<td><?php echo h($frontProduct['FrontProduct']['question']); ?>&nbsp;</td>
		<td><?php echo h($frontProduct['FrontProduct']['responseid']); ?>&nbsp;</td>
		<td><?php echo h($frontProduct['FrontProduct']['prospect_answer']); ?>&nbsp;</td>
		<td><?php echo h($frontProduct['FrontProduct']['active']); ?>&nbsp;</td>
		<td><?php echo h($frontProduct['FrontProduct']['created']); ?>&nbsp;</td>
		<td><?php echo h($frontProduct['FrontProduct']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $frontProduct['FrontProduct']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $frontProduct['FrontProduct']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $frontProduct['FrontProduct']['id']), null, __('Are you sure you want to delete # %s?', $frontProduct['FrontProduct']['id'])); ?>
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

