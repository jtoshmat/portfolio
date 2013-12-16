<nav class="secondary"><ul>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
		
	</ul></nav><div class="products view">
<h2><?php  echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['short_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Long Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['long_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($product['Product']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brochure Link'); ?></dt>
		<dd>
			<?php echo h($product['Product']['brochure_link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['User']['id'], array('controller' => 'users', 'action' => 'view', $product['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($product['Product']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($product['Product']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($product['Question'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Question Text'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Answer Type Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($product['Question'] as $question): ?>
		<tr>
			<td><?php echo $question['id']; ?></td>
			<td><?php echo $question['question_text']; ?></td>
			<td><?php echo $question['user_id']; ?></td>
			<td><?php echo $question['product_id']; ?></td>
			<td><?php echo $question['answer_type_id']; ?></td>
			<td><?php echo $question['active']; ?></td>
			<td><?php echo $question['created']; ?></td>
			<td><?php echo $question['modified']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
<div class="related">
	<h3><?php echo __('Related Prospects'); ?></h3>
	<?php if (!empty($product['Prospect'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Email Address'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State Id'); ?></th>
		<th><?php echo __('Zipcode'); ?></th>
		<th><?php echo __('Phone Number'); ?></th>
		<th><?php echo __('Email Optin-in'); ?></th>
		<th><?php echo __('Language Id'); ?></th>
		<th><?php echo __('Origin Type Id'); ?></th>
		<th><?php echo __('Device Type Id'); ?></th>
		<th><?php echo __('Agent Facebook'); ?></th>
		<th><?php echo __('Global Nick'); ?></th>
		<th><?php echo __('Agent Email Address'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($product['Prospect'] as $prospect): ?>
		<tr>
			<td><?php echo $prospect['id']; ?></td>
			<td><?php echo $prospect['first_name']; ?></td>
			<td><?php echo $prospect['last_name']; ?></td>
			<td><?php echo $prospect['email_address']; ?></td>
			<td><?php echo $prospect['address']; ?></td>
			<td><?php echo $prospect['city']; ?></td>
			<td><?php echo $prospect['state_id']; ?></td>
			<td><?php echo $prospect['zipcode']; ?></td>
			<td><?php echo $prospect['phone_number']; ?></td>
			<td><?php echo $prospect['email_optin-in']; ?></td>
			<td><?php echo $prospect['language_id']; ?></td>
			<td><?php echo $prospect['origin_type_id']; ?></td>
			<td><?php echo $prospect['device_type_id']; ?></td>
			<td><?php echo $prospect['agent_facebook']; ?></td>
			<td><?php echo $prospect['global_nick']; ?></td>
			<td><?php echo $prospect['agent_email_address']; ?></td>
			<td><?php echo $prospect['created']; ?></td>
			<td><?php echo $prospect['modified']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
