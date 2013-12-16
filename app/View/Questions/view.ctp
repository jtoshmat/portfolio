<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="questions view">
<h2><?php  echo __('Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($question['Question']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Text'); ?></dt>
		<dd>
			<?php echo h($question['Question']['question_text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['User']['id'], array('controller' => 'users', 'action' => 'view', $question['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['Product']['id'], array('controller' => 'products', 'action' => 'view', $question['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($question['AnswerType']['id'], array('controller' => 'answer_types', 'action' => 'view', $question['AnswerType']['id'])); ?>
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

<div class="related">
	<h3><?php echo __('Related Prospect Responses'); ?></h3>
	<?php if (!empty($question['ProspectResponse'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Response Value'); ?></th>
		<th><?php echo __('Prospect Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($question['ProspectResponse'] as $prospectResponse): ?>
		<tr>
			<td><?php echo $prospectResponse['id']; ?></td>
			<td><?php echo $prospectResponse['response_value']; ?></td>
			<td><?php echo $prospectResponse['prospect_id']; ?></td>
			<td><?php echo $prospectResponse['question_id']; ?></td>
			<td><?php echo $prospectResponse['created']; ?></td>
			<td><?php echo $prospectResponse['modified']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
<div class="related">
	<h3><?php echo __('Related Responses'); ?></h3>
	<?php if (!empty($question['Response'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Response Text'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($question['Response'] as $response): ?>
		<tr>
			<td><?php echo $response['id']; ?></td>
			<td><?php echo $response['response_text']; ?></td>
			<td><?php echo $response['user_id']; ?></td>
			<td><?php echo $response['question_id']; ?></td>
			<td><?php echo $response['active']; ?></td>
			<td><?php echo $response['created']; ?></td>
			<td><?php echo $response['modified']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
