<div class="businessQuestions view">
<h2><?php echo __('Business Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($businessQuestion['BusinessQuestion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessQuestion['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $businessQuestion['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessQuestion['Question']['id'], array('controller' => 'questions', 'action' => 'view', $businessQuestion['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo $this->Html->link($businessQuestion['Response']['id'], array('controller' => 'responses', 'action' => 'view', $businessQuestion['Response']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Products'); ?></dt>
		<dd>
			<?php echo h($businessQuestion['BusinessQuestion']['products']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($businessQuestion['BusinessQuestion']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($businessQuestion['BusinessQuestion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($businessQuestion['BusinessQuestion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business Question'), array('action' => 'edit', $businessQuestion['BusinessQuestion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Business Question'), array('action' => 'delete', $businessQuestion['BusinessQuestion']['id']), null, __('Are you sure you want to delete # %s?', $businessQuestion['BusinessQuestion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Front Questions'), array('controller' => 'front_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Front Question'), array('controller' => 'front_questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Front Questions'); ?></h3>
	<?php if (!empty($businessQuestion['FrontQuestion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Buid'); ?></th>
		<th><?php echo __('Short Name'); ?></th>
		<th><?php echo __('Question'); ?></th>
		<th><?php echo __('Response'); ?></th>
		<th><?php echo __('Business Question Id'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Response Id'); ?></th>
		<th><?php echo __('Qid'); ?></th>
		<th><?php echo __('Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($businessQuestion['FrontQuestion'] as $frontQuestion): ?>
		<tr>
			<td><?php echo $frontQuestion['buid']; ?></td>
			<td><?php echo $frontQuestion['short_name']; ?></td>
			<td><?php echo $frontQuestion['question']; ?></td>
			<td><?php echo $frontQuestion['response']; ?></td>
			<td><?php echo $frontQuestion['business_question_id']; ?></td>
			<td><?php echo $frontQuestion['business_id']; ?></td>
			<td><?php echo $frontQuestion['question_id']; ?></td>
			<td><?php echo $frontQuestion['response_id']; ?></td>
			<td><?php echo $frontQuestion['qid']; ?></td>
			<td><?php echo $frontQuestion['id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'front_questions', 'action' => 'view', $frontQuestion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'front_questions', 'action' => 'edit', $frontQuestion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'front_questions', 'action' => 'delete', $frontQuestion['id']), null, __('Are you sure you want to delete # %s?', $frontQuestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Front Question'), array('controller' => 'front_questions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
