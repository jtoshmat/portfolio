<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
//echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="prospects form">
<?php echo $this->Form->create('Prospect'); ?>
	<fieldset>
		<legend><?php echo __('Add Prospect'); ?></legend>
	<?php
		echo $this->Form->input('business_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('address');
		echo $this->Form->input('address2');
		echo $this->Form->input('city');
		echo $this->Form->input('state_id');
		echo $this->Form->input('zip_code');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('best_time_to_call');
		echo $this->Form->input('website');
		echo $this->Form->input('ip_address');
		echo $this->Form->input('ref');
		echo $this->Form->input('agent');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
