<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Origin Type'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="originTypes form">
<?php echo $this->Form->create('OriginType'); ?>
	<fieldset>
		<legend><?php echo __('Add Origin Type'); ?></legend>
	<?php
		echo $this->Form->input('short_name');
		echo $this->Form->input('description');
		echo $this->Form->input('user_id',array('disabled'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

