<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="responses form">
<?php echo $this->Form->create('Response'); ?>
	<fieldset>
		<legend><?php echo __('Edit Response'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('short_name');
		echo $this->Form->input('html_input_id');
		echo $this->Form->input('response_answer_id');
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$current_user['id']));
		if ($current_user['group_id']==1){
			echo $this->Form->input('active');
		}else{
			echo $this->Form->input('active',array('type'=>'hidden','value'=>0));
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>