<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="customs view">
<h2><?php echo __('Custom'); ?></h2>
	<dl>
		<dt><?php echo __('Qid'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['qid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business Name'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['Business Name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['Question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['Response']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qrsid'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['qrsid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buid'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['buid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resid'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['resid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bquesid'); ?></dt>
		<dd>
			<?php echo h($custom['Custom']['bquesid']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Custom'), array('action' => 'edit', $custom['Custom']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Custom'), array('action' => 'delete', $custom['Custom']['id']), null, __('Are you sure you want to delete # %s?', $custom['Custom']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Customs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Custom'), array('action' => 'add')); ?> </li>
	</ul>
</div>
