<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Answer Type'), array('action' => 'add')); ?></li>
		
	</ul></nav>
<div class="answerTypes index">
	<h2><?php echo __('Answer Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('common_name'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($answerTypes as $answerType): ?>
	<tr>
		<td><?php echo h($answerType['AnswerType']['id']); ?>&nbsp;</td>
		<td><?php echo h($answerType['AnswerType']['common_name']); ?>&nbsp;</td>
		<td><?php echo h($answerType['AnswerType']['type']); ?>&nbsp;</td>
		<td><?php echo h($answerType['AnswerType']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($answerType['User']['id'], array('controller' => 'users', 'action' => 'view', $answerType['User']['id'])); ?>
		</td>
		<td><?php echo h($answerType['AnswerType']['created']); ?>&nbsp;</td>
		<td><?php echo h($answerType['AnswerType']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $answerType['AnswerType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $answerType['AnswerType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $answerType['AnswerType']['id']), null, __('Are you sure you want to delete # %s?', $answerType['AnswerType']['id'])); ?>
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

