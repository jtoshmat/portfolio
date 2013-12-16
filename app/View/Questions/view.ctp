<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="questions view">
<h2><?php echo __('Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($question['Question']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($question['Question']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['User']['id'], array('controller' => 'users', 'action' => 'view', $question['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($question['Question']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($question['Question']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($question['Question']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question'), array('action' => 'edit', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customs'), array('controller' => 'customs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Custom'), array('controller' => 'customs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Customs'); ?></h3>
	<?php if (!empty($question['Custom'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Business Name'); ?></th>
		<th><?php echo __('Question'); ?></th>
		<th><?php echo __('Response'); ?></th>
		<th><?php echo __('Products'); ?></th>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Response Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Qid'); ?></th>
		<th><?php echo __('Qrsid'); ?></th>
		<th><?php echo __('Resid'); ?></th>
		<th><?php echo __('Bid'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($question['Custom'] as $custom): ?>
		<tr>
			<td><?php echo $custom['Business Name']; ?></td>
			<td><?php echo $custom['Question']; ?></td>
			<td><?php echo $custom['Response']; ?></td>
			<td><?php echo $custom['Products']; ?></td>
			<td><?php echo $custom['id']; ?></td>
			<td><?php echo $custom['business_id']; ?></td>
			<td><?php echo $custom['question_id']; ?></td>
			<td><?php echo $custom['response_id']; ?></td>
			<td><?php echo $custom['status']; ?></td>
			<td><?php echo $custom['qid']; ?></td>
			<td><?php echo $custom['qrsid']; ?></td>
			<td><?php echo $custom['resid']; ?></td>
			<td><?php echo $custom['bid']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'customs', 'action' => 'view', $custom['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'customs', 'action' => 'edit', $custom['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'customs', 'action' => 'delete', $custom['id']), null, __('Are you sure you want to delete # %s?', $custom['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Custom'), array('controller' => 'customs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
