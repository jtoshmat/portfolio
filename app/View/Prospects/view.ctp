<?php
$cont = $this->params['controller'];
$act = $this->params['action'];

//allow this controller/view
//echo $this->element("view_authorized", array('controller' => $cont,'action' => $act));

//deny this view
echo $this->element("view_authorized", array('controller' => '','action' => ''));
?>
<div class="prospects view">
<h2><?php echo __('Prospect'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business Name'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['business_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($prospect['State']['id'], array('controller' => 'states', 'action' => 'view', $prospect['State']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip Code'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['zip_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Best Time To Call'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['best_time_to_call']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip Address'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ref'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['ref']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agent'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['agent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($prospect['Prospect']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

