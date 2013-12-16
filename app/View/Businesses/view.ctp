<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="businesses view">
<h2><?php echo __('Business'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($business['Business']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($business['Business']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo $this->Html->link($business['User']['username'], array('controller' => 'users', 'action' => 'view', $business['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php
			$status = h($business['Business']['active']);
			$status = ($status==1)?"Yes":"No";
			echo $status;?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($business['Business']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($business['Business']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Business'), array('action' => 'edit', $business['Business']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Business'), array('action' => 'delete', $business['Business']['id']), null, __('Are you sure you want to delete # %s?', $business['Business']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Businesses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Business'), array('action' => 'add')); ?> </li>
		<?php
		if ($current_user['group_id']==1){
		?>
		<li><?php echo $this->Html->link(__('Approve'), array('controller' => 'businesses', 'action' => 'index')); ?> </li>
		<?php
		}
		?>
	</ul>
</div>

<div class="related">
	<h3><?php echo __('Related Questions & Responses'); ?></h3>
	<?php if (!empty($business['BusinessQuestion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business'); ?></th>
		<th><?php echo __('Question'); ?></th>
		<th><?php echo __('Response'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($business['BusinessQuestion'] as $bus):
	$qus_short_name = $this->requestAction("Questions/view/".$bus['question_id']);
	$qs = $qus_short_name['Question']['short_name'];
	$res_short_name = $this->requestAction("questionresponses/getview/".$bus['question_id']);
	?>
		<tr>
			<td><?php echo $bus['id']; ?></td>
			<td><?php echo $business['Business']['short_name']; ?></td>
			<td><?php echo $this->Html->link($qs, array('controller' => 'questionresponses', 'action' => 'edit', 10,$bus['question_id'],$bus['business_id']));  ?></td>
			<td><?php echo $res_short_name[0]['Response']['short_name']; ?></td>
			<td><?php echo $bus['created']; ?></td>
			<td><?php echo $bus['modified']; ?></td>
			<td class="actions">

			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>

