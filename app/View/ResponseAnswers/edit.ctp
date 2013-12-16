<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="responseAnswers form">
<?php echo $this->Form->create('ResponseAnswer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Response Answer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('short_name');
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

