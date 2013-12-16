<div class="frontQuestions index">
	<h2><?php echo __('Front Questions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('Business'); ?></th>
			<th><?php echo $this->Paginator->sort('Question'); ?></th>
			<th><?php echo $this->Paginator->sort('Response'); ?></th>
			<th><?php echo $this->Paginator->sort('products'); ?></th>

	</tr>
	<?php foreach ($frontQuestions as $frontQuestion): ?>
	<tr>
		<td><?php echo h($frontQuestion['FrontQuestion']['id']); ?>&nbsp;</td>
		<td><?php echo h($frontQuestion['FrontQuestion']['Business']); ?>&nbsp;</td>
		<td><?php echo h($frontQuestion['FrontQuestion']['Question']); ?>&nbsp;</td>
		<td><?php echo h($frontQuestion['FrontQuestion']['Response']); ?>&nbsp;</td>

		<td><?php echo h($frontQuestion['FrontQuestion']['products']); ?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
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

