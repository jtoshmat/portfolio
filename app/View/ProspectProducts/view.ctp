<div class="prospectProducts view">
<h2><?php  echo __('Prospect Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prospectProduct['ProspectProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospectProduct['Product']['id'], array('controller' => 'products', 'action' => 'view', $prospectProduct['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prospect'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospectProduct['Prospect']['id'], array('controller' => 'prospects', 'action' => 'view', $prospectProduct['Prospect']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($prospectProduct['ProspectProduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($prospectProduct['ProspectProduct']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prospect Product'), array('action' => 'edit', $prospectProduct['ProspectProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prospect Product'), array('action' => 'delete', $prospectProduct['ProspectProduct']['id']), null, __('Are you sure you want to delete # %s?', $prospectProduct['ProspectProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospect Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
	</ul>
</div>
