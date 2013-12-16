<div class="frontProducts view">
<h2><?php echo __('Front Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prospect'); ?></dt>
		<dd>
			<?php echo $this->Html->link($frontProduct['Prospect']['id'], array('controller' => 'prospects', 'action' => 'view', $frontProduct['Prospect']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Products'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['products']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['business']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Responseid'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['responseid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prospect Answer'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['prospect_answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($frontProduct['FrontProduct']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

