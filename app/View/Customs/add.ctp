<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="customs form">
<?php echo $this->Form->create('Custom'); ?>
	<fieldset>
		<legend><?php echo __('Add Custom'); ?></legend>
	<?php
		echo $this->Form->input('qid');
		echo $this->Form->input('Business Name');
		echo $this->Form->input('Question');
		echo $this->Form->input('Response');
		echo $this->Form->input('qrsid');
		echo $this->Form->input('buid');
		echo $this->Form->input('resid');
		echo $this->Form->input('bquesid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Customs'), array('action' => 'index')); ?></li>
	</ul>
</div>
