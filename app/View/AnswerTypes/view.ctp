<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Answer Type'), array('action' => 'add')); ?></li>

		
	</ul></nav>
<div class="answerTypes view">
<h2><?php  echo __('Answer Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($answerType['AnswerType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Common Name'); ?></dt>
		<dd>
			<?php echo h($answerType['AnswerType']['common_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($answerType['AnswerType']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($answerType['AnswerType']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($answerType['User']['id'], array('controller' => 'users', 'action' => 'view', $answerType['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($answerType['AnswerType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($answerType['AnswerType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($answerType['Question'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Question Text'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Answer Type Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($answerType['Question'] as $question): ?>
		<tr>
			<td><?php echo $question['id']; ?></td>
			<td><?php echo $question['question_text']; ?></td>
			<td><?php echo $question['user_id']; ?></td>
			<td><?php echo $question['product_id']; ?></td>
			<td><?php echo $question['answer_type_id']; ?></td>
			<td><?php echo $question['active']; ?></td>
			<td><?php echo $question['created']; ?></td>
			<td><?php echo $question['modified']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
