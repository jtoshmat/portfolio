<div class="htmlInputs index">
	<h2><?php echo __('Html Inputs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('short_name'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($htmlInputs as $htmlInput): ?>
	<tr>
		<td><?php echo h($htmlInput['HtmlInput']['id']); ?>&nbsp;</td>
		<td><?php echo h($htmlInput['HtmlInput']['short_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($htmlInput['User']['id'], array('controller' => 'users', 'action' => 'view', $htmlInput['User']['id'])); ?>
		</td>
		<td><?php echo h($htmlInput['HtmlInput']['active']); ?>&nbsp;</td>
		<td><?php echo h($htmlInput['HtmlInput']['created']); ?>&nbsp;</td>
		<td><?php echo h($htmlInput['HtmlInput']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $htmlInput['HtmlInput']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $htmlInput['HtmlInput']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $htmlInput['HtmlInput']['id']), null, __('Are you sure you want to delete # %s?', $htmlInput['HtmlInput']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Html Input'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
