<div class="htmlInputs view">
<h2><?php echo __('Html Input'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($htmlInput['HtmlInput']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($htmlInput['HtmlInput']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($htmlInput['User']['id'], array('controller' => 'users', 'action' => 'view', $htmlInput['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($htmlInput['HtmlInput']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($htmlInput['HtmlInput']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($htmlInput['HtmlInput']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Responses'); ?></h3>
	<?php if (!empty($htmlInput['Response'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Short Name'); ?></th>
		<th><?php echo __('Html Input Id'); ?></th>
		<th><?php echo __('Response Answer Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($htmlInput['Response'] as $response): ?>
		<tr>
			<td><?php echo $response['id']; ?></td>
			<td><?php echo $response['short_name']; ?></td>
			<td><?php echo $response['html_input_id']; ?></td>
			<td><?php echo $response['response_answer_id']; ?></td>
			<td><?php echo $response['user_id']; ?></td>
			<td><?php echo $response['active']; ?></td>
			<td><?php echo $response['created']; ?></td>
			<td><?php echo $response['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'responses', 'action' => 'view', $response['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'responses', 'action' => 'edit', $response['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'responses', 'action' => 'delete', $response['id']), null, __('Are you sure you want to delete # %s?', $response['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

