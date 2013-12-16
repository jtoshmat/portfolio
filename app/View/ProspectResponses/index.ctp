<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="prospectResponses index">
	<h2><?php echo __('Prospect Responses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('prospect_id'); ?></th>
			<th><?php echo $this->Paginator->sort('products'); ?></th>
			<th><?php echo $this->Paginator->sort('business'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th><?php echo $this->Paginator->sort('responseid'); ?></th>
			<th><?php echo $this->Paginator->sort('prospect_answer'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($prospectResponses as $prospectResponse): ?>
	<tr>
		<td><?php echo h($prospectResponse['ProspectResponse']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($prospectResponse['Prospect']['id'], array('controller' => 'prospects', 'action' => 'view', $prospectResponse['Prospect']['id'])); ?>
		</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['products']); ?>&nbsp;</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['business']); ?>&nbsp;</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['question']); ?>&nbsp;</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['responseid']); ?>&nbsp;</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['prospect_answer']); ?>&nbsp;</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['active']); ?>&nbsp;</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['created']); ?>&nbsp;</td>
		<td><?php echo h($prospectResponse['ProspectResponse']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $prospectResponse['ProspectResponse']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $prospectResponse['ProspectResponse']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $prospectResponse['ProspectResponse']['id']), null, __('Are you sure you want to delete # %s?', $prospectResponse['ProspectResponse']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Prospect Response'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
	</ul>
</div>
