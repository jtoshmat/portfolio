<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="responseAnswers view">
<h2><?php echo __('Response Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($responseAnswer['ResponseAnswer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($responseAnswer['ResponseAnswer']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($responseAnswer['User']['id'], array('controller' => 'users', 'action' => 'view', $responseAnswer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($responseAnswer['ResponseAnswer']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($responseAnswer['ResponseAnswer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($responseAnswer['ResponseAnswer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Responses'); ?></h3>
	<?php if (!empty($responseAnswer['Response'])): ?>
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
	<?php foreach ($responseAnswer['Response'] as $response): ?>
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
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'responses', 'action' => 'delete', $response['id']), null, __('Are you sure you want to delete # %s?', $response['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
