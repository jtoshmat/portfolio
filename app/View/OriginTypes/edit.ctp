<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Language'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="originTypes form">
<?php echo $this->Form->create('OriginType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Origin Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('short_name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

