<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Response'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="responses index">
	<h2><?php echo __('Responses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('response_text'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($responses as $response): ?>
	<tr>
		<td><?php echo h($response['Response']['id']); ?>&nbsp;</td>
		<td><?php echo h($response['Response']['response_text']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($response['User']['id'], array('controller' => 'users', 'action' => 'view', $response['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($response['Question']['id'], array('controller' => 'questions', 'action' => 'view', $response['Question']['id'])); ?>
		</td>
		<td><?php echo h($response['Response']['active']); ?>&nbsp;</td>
		<td><?php echo h($response['Response']['created']); ?>&nbsp;</td>
		<td><?php echo h($response['Response']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $response['Response']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $response['Response']['id'])); ?>
			
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

