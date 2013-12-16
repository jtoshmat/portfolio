<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="responseAnswers index">
	<h2><?php echo __('Response Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('short_name'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($responseAnswers as $responseAnswer):
		$status = $responseAnswer['ResponseAnswer']['active'];
	$status = ($status==1)?"Yes":"No";
	$css_class = ($status==1)?"bus_".$status:"bus_".$status;

	echo "<tr class='".$css_class."'>";
	?>
		<td><?php echo h($responseAnswer['ResponseAnswer']['id']); ?>&nbsp;</td>
		<td><?php echo h($responseAnswer['ResponseAnswer']['short_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($responseAnswer['User']['username'], array('controller' => 'users', 'action' => 'view', $responseAnswer['User']['id'])); ?>
		</td>
		<td><?php echo $status; ?>&nbsp;</td>
		<td><?php echo h($responseAnswer['ResponseAnswer']['created']); ?>&nbsp;</td>
		<td><?php echo h($responseAnswer['ResponseAnswer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $responseAnswer['ResponseAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Add'), array('action' => 'Add', $responseAnswer['ResponseAnswer']['id'])); ?>

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

