<div class="siteSettings index">
	<h2><?php echo __('Site Settings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('short_name'); ?></th>
			<th><?php echo $this->Paginator->sort('value1'); ?></th>
			<th><?php echo $this->Paginator->sort('value2'); ?></th>
			<th><?php echo $this->Paginator->sort('value3'); ?></th>
			<th><?php echo $this->Paginator->sort('value4'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($siteSettings as $siteSetting): ?>
	<tr>
		<td><?php echo h($siteSetting['SiteSetting']['id']); ?>&nbsp;</td>
		<td><?php echo h($siteSetting['SiteSetting']['short_name']); ?>&nbsp;</td>
		<td><?php echo h($siteSetting['SiteSetting']['value1']); ?>&nbsp;</td>
		<td><?php echo h($siteSetting['SiteSetting']['value2']); ?>&nbsp;</td>
		<td><?php echo h($siteSetting['SiteSetting']['value3']); ?>&nbsp;</td>
		<td><?php echo h($siteSetting['SiteSetting']['value4']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($siteSetting['User']['id'], array('controller' => 'users', 'action' => 'view', $siteSetting['User']['id'])); ?>
		</td>
		<td><?php echo h($siteSetting['SiteSetting']['active']); ?>&nbsp;</td>
		<td><?php echo h($siteSetting['SiteSetting']['created']); ?>&nbsp;</td>
		<td><?php echo h($siteSetting['SiteSetting']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $siteSetting['SiteSetting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $siteSetting['SiteSetting']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $siteSetting['SiteSetting']['id']), null, __('Are you sure you want to delete # %s?', $siteSetting['SiteSetting']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Site Setting'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
