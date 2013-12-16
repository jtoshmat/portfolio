<div class="siteSettings view">
<h2><?php echo __('Site Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value1'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['value1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value2'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['value2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value3'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['value3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value4'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['value4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($siteSetting['User']['id'], array('controller' => 'users', 'action' => 'view', $siteSetting['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($siteSetting['SiteSetting']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Site Setting'), array('action' => 'edit', $siteSetting['SiteSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Site Setting'), array('action' => 'delete', $siteSetting['SiteSetting']['id']), null, __('Are you sure you want to delete # %s?', $siteSetting['SiteSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Setting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
