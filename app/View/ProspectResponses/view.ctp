<div class="prospectResponses view">
<h2><?php  echo __('Prospect Response'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response Value'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['response_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prospect'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospectResponse['Prospect']['id'], array('controller' => 'prospects', 'action' => 'view', $prospectResponse['Prospect']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospectResponse['Question']['id'], array('controller' => 'questions', 'action' => 'view', $prospectResponse['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prospect Response'), array('action' => 'edit', $prospectResponse['ProspectResponse']['prospect_response_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prospect Response'), array('action' => 'delete', $prospectResponse['ProspectResponse']['prospect_response_id']), null, __('Are you sure you want to delete # %s?', $prospectResponse['ProspectResponse']['prospect_response_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospect Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect Response'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
