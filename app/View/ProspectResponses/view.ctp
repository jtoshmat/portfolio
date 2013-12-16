<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="prospectResponses view">
<h2><?php echo __('Prospect Response'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prospect'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospectResponse['Prospect']['id'], array('controller' => 'prospects', 'action' => 'view', $prospectResponse['Prospect']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Products'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['products']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['business']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Responseid'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['responseid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prospect Answer'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['prospect_answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($prospectResponse['ProspectResponse']['active']); ?>
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
		<li><?php echo $this->Html->link(__('Edit Prospect Response'), array('action' => 'edit', $prospectResponse['ProspectResponse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prospect Response'), array('action' => 'delete', $prospectResponse['ProspectResponse']['id']), null, __('Are you sure you want to delete # %s?', $prospectResponse['ProspectResponse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospect Responses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect Response'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
	</ul>
</div>
