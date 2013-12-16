<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="responses view">
<h2><?php echo __('Response'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($response['Response']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($response['Response']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Html Input'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['HtmlInput']['id'], array('controller' => 'html_inputs', 'action' => 'view', $response['HtmlInput']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response Answer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['ResponseAnswer']['id'], array('controller' => 'response_answers', 'action' => 'view', $response['ResponseAnswer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($response['User']['id'], array('controller' => 'users', 'action' => 'view', $response['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($response['Response']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($response['Response']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($response['Response']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Business Questions'); ?></h3>
	<?php if (!empty($response['BusinessQuestion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Response Id'); ?></th>
		<th><?php echo __('Products'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($response['BusinessQuestion'] as $businessQuestion): ?>
		<tr>
			<td><?php echo $businessQuestion['id']; ?></td>
			<td><?php echo $businessQuestion['business_id']; ?></td>
			<td><?php echo $businessQuestion['question_id']; ?></td>
			<td><?php echo $businessQuestion['response_id']; ?></td>
			<td><?php echo $businessQuestion['products']; ?></td>
			<td><?php echo $businessQuestion['active']; ?></td>
			<td><?php echo $businessQuestion['created']; ?></td>
			<td><?php echo $businessQuestion['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'business_questions', 'action' => 'view', $businessQuestion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'business_questions', 'action' => 'edit', $businessQuestion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'business_questions', 'action' => 'delete', $businessQuestion['id']), null, __('Are you sure you want to delete # %s?', $businessQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Customs'); ?></h3>
	<?php if (!empty($response['Custom'])): ?>
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
	<?php foreach ($response['Custom'] as $custom): ?>
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

</div>
<div class="related">
	<h3><?php echo __('Related Front Questions'); ?></h3>
	<?php if (!empty($response['FrontQuestion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business'); ?></th>
		<th><?php echo __('Question'); ?></th>
		<th><?php echo __('Response'); ?></th>
		<th><?php echo __('Html'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Response Id'); ?></th>
		<th><?php echo __('Products'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($response['FrontQuestion'] as $frontQuestion): ?>
		<tr>
			<td><?php echo $frontQuestion['id']; ?></td>
			<td><?php echo $frontQuestion['Business']; ?></td>
			<td><?php echo $frontQuestion['Question']; ?></td>
			<td><?php echo $frontQuestion['Response']; ?></td>
			<td><?php echo $frontQuestion['Html']; ?></td>
			<td><?php echo $frontQuestion['business_id']; ?></td>
			<td><?php echo $frontQuestion['question_id']; ?></td>
			<td><?php echo $frontQuestion['response_id']; ?></td>
			<td><?php echo $frontQuestion['products']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'front_questions', 'action' => 'view', $frontQuestion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'front_questions', 'action' => 'edit', $frontQuestion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'front_questions', 'action' => 'delete', $frontQuestion['id']), null, __('Are you sure you want to delete # %s?', $frontQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
