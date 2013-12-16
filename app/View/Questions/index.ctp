
<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="questions index">
	<h2><?php echo __('Questions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_text'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('answer_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($questions as $question): ?>
	<tr>
		<td><?php echo h($question['Question']['id']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['question_text']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($question['User']['id'], array('controller' => 'users', 'action' => 'view', $question['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($question['Product']['id'], array('controller' => 'products', 'action' => 'view', $question['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($question['AnswerType']['id'], array('controller' => 'answer_types', 'action' => 'view', $question['AnswerType']['id'])); ?>
		</td>
		<td><?php echo h($question['Question']['active']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['created']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $question['Question']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['id'])); ?>
			
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