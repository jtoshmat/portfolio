<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div id="customs_index" class="customs form">
<?php echo $this->Form->create('Custom', array('novalidate' => true)); ?>



	<h2><?php echo __('Simple Editor'); ?></h2>
	<p><input id="bus_expand_collapse" type="checkbox"><label id="label_expand_collapse" for="bus_expand_collapse">Expand All</label></p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('bid'); ?></th>
			<th><?php echo $this->Paginator->sort('Business'); ?></th>
			<th><?php echo $this->Paginator->sort('Question'); ?></th>
			<th><?php echo $this->Paginator->sort('Response'); ?></th>
			<th><?php echo "Products" ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	$prid=0; $msg = ""; $uid=0;
	foreach ($customs as $custom):
	$status = $custom['Custom']['status'];
	$default_id = settype($custom['Custom']['bid'],'integer');
	$status = ($status==1)?"Yes":"No";
	$group = "bus_groups";
	$css_class = ($status==1)?"bus_".$status:"bus_".$status;

	if ($uid === 0){
		$msg = "first";
		$uid = $default_id;
	}else{

			$assign_id = $custom['Custom']['bid'];
			$msg = $uid."==".$assign_id;
			if ("$uid"=="$assign_id"){
				$msg = "same";
				}else{
				$uid = $custom['Custom']['bid'];
				$msg = "diff";
			}
	}

		$cls = "";
		if ($msg=='first'){
			$cls = "group_".$custom['Custom']['bid']."";
			echo "<tbody id='".$cls."'>";
			echo "<tr class='bus_categories'><td colspan='6'>".h($custom['Custom']['Business'])."</td></tr>";
		}else{

				if ($msg=='diff'){
				$cls = "group_".$custom['Custom']['bid']."";
				echo "<tbody id='".$cls."'>";
					echo "<tr class='bus_categories'><td colspan='6'>".h($custom['Custom']['Business'])."</td></tr>";

				}
		}

	echo "<tr class='".$css_class." ".$group."'>";
	?>
		<td><?php echo h($custom['Custom']['bid']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($custom['Custom']['Business'], array('controller' => 'businessquestions', 'action' => 'edit', $custom['Custom']['qrsid'])); ?></td>
		<td><?php echo $this->Html->link($custom['Custom']['Question'], array('controller' => 'businessquestions', 'action' => 'edit', $custom['Custom']['qrsid'])); ?></td>
		<td><?php echo $this->Html->link($custom['Custom']['Response'], array('controller' => 'businessquestions', 'action' => 'edit', $custom['Custom']['qrsid'])); ?></td>
		<td>
		<?php //echo $this->Html->link('Products', array('controller' => 'businessproducts', 'action' => 'index'));

			if ($custom['Custom']['Products']!=''){
			$prods = explode(";",$custom['Custom']['Products']);



			echo "<ul>";
			for ($i=0;$i<count($prods);$i++){
				if ($prods[$i]!='' && $prods[$i]!=1){
					$getpid = $this->requestAction(array('controller' => 'Products', 'action' => 'view',$prods[$i]));
					echo "<li>".$getpid['Product']['short_name']."</li>";
				}
			}
			echo "<li>".$this->Html->link('Edit', array('controller' => 'businessquestions', 'action' => 'edit', $custom['Custom']['qrsid']))."</li>";
			echo "</ul>";


			}else{
			echo $this->Html->image("add.png", array("height" => "30", "width" => "35", "alt" => "Assign",'url' => array('controller' => 'businessquestions', 'action' => 'edit', $custom['Custom']['qrsid'])));
			}

		?></td>
		<td class="actions">
			 <?php //echo $msg;?>
		</td>
	</tr>
<?php

if ($msg=='same'){
$cls = "other_".$msg."";
	//echo "</tbody>";
//echo "<tr class='bus_categories'><td colspan='5'>".h($custom['Custom']['Business'])."</td></tr>";

}


?>


<?php endforeach; ?>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>

	</tr>

	<tr class="bus_new">
		<td>New</td>
		<td>
		<?php
 		$getbus = $this->requestAction(array('controller' => 'Businesses', 'action' => 'index'));
		foreach ($getbus as $gb){
			$gb_options[$gb['Business']['id']] = $gb['Business']['short_name'];
		}
		echo $this->Form->input('business_id',array('label'=>'','type'=>'select','options'=>$gb_options,'empty'=>'Select Business'));

		?>
		</td>
		<td>
		<?php
		$getqs = $this->requestAction(array('controller' => 'Questions', 'action' => 'index'));

		foreach ($getqs as $ques){
			$ques_options[$ques['Question']['id']] = $ques['Question']['short_name'];
		}
		echo $this->Form->input('question_id',array('label'=>'','type'=>'select','options'=>$ques_options,'empty'=>'Select Question'));
		?>
		</td>
		<td>
		<?php
		$getrs = $this->requestAction(array('controller' => 'Responses', 'action' => 'index'));
		foreach ($getrs as $res){
			$res_options[$res['Response']['id']] = $res['Response']['short_name'];
		}
		echo $this->Form->input('response_id',array('label'=>'','type'=>'select','options'=>$res_options,'empty'=>'Select Response'));

		?>

		</td>
		<td>
		<?php
		$getpid = $this->requestAction(array('controller' => 'Products', 'action' => 'index'));
		foreach ($getpid as $pod){
		if ($pod['Product']['id']!=1){
			$prod_options[$pod['Product']['id']] = $pod['Product']['short_name'];
			}
		}

		echo $this->Form->input('products', array('type'=>'select','multiple' => true,'options'=>$prod_options,'empty'=>'Select Products'));
		?>

		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td colspan="6" style="text-align:center;">
		<?php echo $this->Form->end(__('Add New')); ?>
	</td>
	</tr>
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
<div class="custom_admin_menu">
<?php
echo "<ul>";
echo "<li>Level 1: </li>";
echo "<li>". $this->Html->link('Businesses', array('controller'=>'businesses','action' => 'index')). "</li>";
echo "<li>". $this->Html->link('Questions', array('controller'=>'questions','action' => 'index')). "</li>";
echo "<li>". $this->Html->link('Responses', array('controller'=>'responses','action' => 'index')). "</li>";
echo "<li>". $this->Html->link('Products', array('controller'=>'products','action' => 'index')). "</li>";
echo "<br />";
echo "<li>Level 2: </li>";
echo "<li>". $this->Html->link('Answers for Responses', array('controller'=>'responseanswers','action' => 'index')). "</li>";
echo "<br />";
echo "<li>Admin Settings: </li>";
echo "<li>". $this->Html->link('Site Settings', array('controller'=>'settings','action' => 'index')). "</li>";
echo "<li>". $this->Html->link('Users', array('controller'=>'users','action' => 'index')). "</li>";
echo "<li>". $this->Html->link('Roles', array('controller'=>'groups','action' => 'index')). "</li>";
echo "<br />";
echo "<li>Frontend Settings: </li>";
echo "<li>". $this->Html->link('Questions', array('controller'=>'frontquestions','action' => 'index')). "</li>";
echo "<li>". $this->Html->link('Products', array('controller'=>'frontproducts','action' => 'index')). "</li>";
echo "<li>". $this->Html->link('Prospects', array('controller'=>'prospects','action' => 'index')). "</li>";
echo "</ul>";
?>
</div>


