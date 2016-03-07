<?= $this->assign('title', 'Herts Cubs - Champion Home Page'); ?>

<div class="landing actions columns large-2 medium-3">

	<?= $this->start('Sidebar');
	echo $this->element('Sidebar/champion');
	$this->end(); ?>
	
	<?= $this->fetch('Sidebar') ?>
	
</div>

<div class="landing admin_home large-9 medium-9 columns content">
	<div>
	</br>
		<p>Key administration tasks can be accomplished from this Champion section, which has enhanced control over applications and data for your District.</p>
	</div>
</div>

<div class="landing admin_home large-10 medium-9 columns content">
	<table class="goat" cellpadding="0" cellspacing="0">
        <tr class="goat">
        	<th class="goat"><?= __('Users'); ?></th>
			<th class="goat"><?= __('Applications'); ?></th>
			<th class="goat"><?= __('Attendees'); ?></th>
			<th class="goat"><?= __('Financial'); ?></th>
			<th class="goat"><?= __('Champions'); ?></th>
			<th class="goat"><?= __('Scout Groups & Districts'); ?></th>
        </tr>
        <tr class="goat">
        	<td class="goat"><?= $this->Html->link('Users', ['prefix' => 'champion','controller' => 'Users', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Applications', ['prefix' => 'champion','controller' => 'Applications', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Attendees', ['prefix' => 'champion', 'controller' => 'Attendees', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Invoices', ['prefix' => 'champion', 'controller' => 'Invoices', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Champions', ['prefix' => 'champion', 'controller' => 'Champions', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Districts', ['prefix' => 'champion', 'controller' => 'Districts', 'action' => 'index']); ?></td>
        </tr>
        <tr class="goat">
        	<td class="goat"><?= $this->Html->link('Add User', ['prefix' => 'champion','controller' => 'Users', 'action' => 'add']); ?></td>
			<td class="goat"><?= $this->Html->link('Add Application', ['prefix' => 'champion','controller' => 'Applications', 'action' => 'add']); ?></td>
			<td class="goat"><?= $this->Html->link('Add Attendee', ['prefix' => 'champion', 'controller' => 'Attendees', 'action' => 'add']); ?></td>
			<td class="goat"><?= $this->Html->link('Add Invoice', ['prefix' => 'champion', 'controller' => 'Invoices', 'action' => 'add']); ?></td>
			<td class="goat"></td>
			<td class="goat"><?= $this->Html->link('District Scout Groups', ['prefix' => 'champion', 'controller' => 'Scoutgroups', 'action' => 'index']); ?></td>
        </tr>
        <tr class="goat">
			<td class="goat"></td>
			<td class="goat"></td>
			<td class="goat"><?= $this->Html->link('Allergies', ['prefix' => 'champion', 'controller' => 'Allergies', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Payments', ['prefix' => 'champion', 'controller' => 'Payments', 'action' => 'index']); ?></td>
			<td class="goat"></td>
			<td class="goat"><?= $this->Html->link('Scout Groups', ['prefix' => 'champion', 'controller' => 'Scoutgroups', 'action' => 'allIndex']); ?></td>
        </tr>
        <tr class="goat">
			<td class="goat"></td>
			<td class="goat"></td>
			<td class="goat"><?= $this->Html->link('Add Allergy', ['prefix' => 'champion', 'controller' => 'Allergies', 'action' => 'add']); ?></td>
			<td class="goat"><?= $this->Html->link('Line Items', ['prefix' => 'champion', 'controller' => 'InvoiceItems', 'action' => 'index']); ?></td>
			<td class="goat"></td>
			<td class="goat"><?= $this->Html->link('Add Scout Group', ['prefix' => 'champion', 'controller' => 'Scoutgroups', 'action' => 'add']); ?></td>
        </tr>
    </table>
</div>

</div>