<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="businesses index">
	<h2><?php echo __('Businesses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('short_name'); ?></th>
			<th><?php //echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th>&nbsp;</th>

	</tr>
	<?php foreach ($businesses as $business): ?>
	<?php
	$status = $business['Business']['active'];
	$status = ($status==1)?"Yes":"No";
	$css_class = ($status==1)?"bus_".$status:"bus_".$status;

	echo "<tr class='".$css_class."'>";
	?>

		<td>
		<?php if ($current_user['group_id']==1){?>
		<input type="checkbox" name="approve" value="1">
		<?php }?>
		<?php echo h($business['Business']['id']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['short_name']); ?>&nbsp;</td>
		<td>
			<?php // echo $this->Html->link($business['User']['id'], array('controller' => 'users', 'action' => 'view', $business['User']['id'])); ?>
		</td>
		<td><?php
		echo $status;
		?>&nbsp;
		</td>
		<td><?php echo h($business['Business']['created']); ?>&nbsp;</td>
		<td><?php echo h($business['Business']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $business['Business']['id'])); ?>
			<?php echo $this->Html->link(__('Add'), array('action' => 'add', $business['Business']['id'])); ?>


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