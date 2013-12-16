<div class="frontQuestions view">
<h2><?php echo __('Front Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($frontQuestion['FrontQuestion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo h($frontQuestion['FrontQuestion']['Business']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($frontQuestion['FrontQuestion']['Question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo h($frontQuestion['FrontQuestion']['Response']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo $this->Html->link($frontQuestion['Business']['id'], array('controller' => 'businesses', 'action' => 'view', $frontQuestion['Business']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($frontQuestion['Question']['id'], array('controller' => 'questions', 'action' => 'view', $frontQuestion['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo $this->Html->link($frontQuestion['Response']['id'], array('controller' => 'responses', 'action' => 'view', $frontQuestion['Response']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Products'); ?></dt>
		<dd>
			<?php echo h($frontQuestion['FrontQuestion']['products']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Front Question'), array('action' => 'edit', $frontQuestion['FrontQuestion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Front Question'), array('action' => 'delete', $frontQuestion['FrontQuestion']['id']), null, __('Are you sure you want to delete # %s?', $frontQuestion['FrontQuestion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Front Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Front Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Business Questions'), array('controller' => 'business_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business Question'), array('controller' => 'business_questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('controller' => 'businesses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Responses'), array('controller' => 'responses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Response'), array('controller' => 'responses', 'action' => 'add')); ?> </li>
	</ul>
</div>
