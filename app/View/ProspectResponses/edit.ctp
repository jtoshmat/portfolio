<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="prospectResponses form">
<?php echo $this->Form->create('ProspectResponse'); ?>
	<fieldset>
		<legend><?php echo __('Edit Prospect Response'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('prospect_id');
		echo $this->Form->input('products');
		echo $this->Form->input('business');
		echo $this->Form->input('question');
		echo $this->Form->input('responseid');
		echo $this->Form->input('prospect_answer');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProspectResponse.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProspectResponse.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Prospect Responses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Prospects'), array('controller' => 'prospects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prospect'), array('controller' => 'prospects', 'action' => 'add')); ?> </li>
	</ul>
</div>
