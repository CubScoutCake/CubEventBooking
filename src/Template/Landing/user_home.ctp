<?= $this->assign('title', 'Herts Cubs - User Home Page'); ?>
<?= $cell = $this->cell('Notifications', [$userId]); $cell ?>

<div class="landing actions columns large-2 medium-3">

	<?= $this->start('Sidebar');
	echo $this->element('Sidebar/user');	
	$this->end(); ?>
	
	<?= $this->fetch('Sidebar') ?>
	
</div>

<div class="landing user_home large-10 medium-9 columns">
	<div>
		<h3>Hertfordshire Cubs Booking System</h3>
		</br>
		<div class="landing user_home large-4 medium-4 columns">

			<p>Simple steps to booking manually.</p>

			<ol>
				<li><?= $this->Html->link(__('Create an Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
				<li><?= $this->Html->link(__('Add Cubs'), ['controller' => 'Attendees', 'action' => 'cub']) ?></li>
				<li><?= $this->Html->link(__('Add Leaders'), ['controller' => 'Attendees', 'action' => 'adult']) ?></li>
				<li><?= $this->Html->link(__('Generate an Invoice'), ['controller' => 'Invoices', 'action' => 'generate']) ?></li>
			</ol>
		</div>

		<div class="landing user_home large-4 medium-4 columns numbers">
			<table class="summary" cellpadding="0" cellspacing="0">
				<tr>
					<th class="goat"></th>
					<th class="goat"><?= __('Count'); ?></th>
				</tr>
				<tr>
					<th><?= $this->Html->link('Your Applications', ['prefix' => false,'controller' => 'Applications', 'action' => 'index']); ?></th>
					<td><?= $this->Number->format($countApplications); ?></td>
				</tr>
				<tr>	
					<th><?= $this->Html->link('Your Attendees', ['prefix' => false,'controller' => 'Attendees', 'action' => 'index']); ?></th>
					<td><?= $this->Number->format($countAttendees); ?></td>
				</tr>
				<tr>
					<th><?= $this->Html->link('Your Invoices', ['prefix' => false,'controller' => 'Invoices', 'action' => 'index']); ?></th>
					<td><?= $this->Number->format($countInvoices); ?></td>
				</tr>
				<tr>	
					<th><?= $this->Html->link('Your Payments', ['prefix' => false,'controller' => 'Payments', 'action' => 'index']); ?></th>
					<td><?= $this->Number->format($countPayments); ?></td>
				</tr>
			</table>
		</div>
</div>

<div class="landing user_home large-12 medium-12 columns content">
	<h3><?= __('Available Options') ?></h3>
	<table class="goat" cellpadding="0" cellspacing="0">
        <tr class="goat">
			<th class="goat"><?= __('Applications'); ?></th>
			<th class="goat"><?= __('Attendees'); ?></th>
			<th class="goat"><?= __('Financial'); ?></th>
			<th class="goat"><?= __('Additional'); ?></th>
        </tr>
        <tr class="goat">
			<td class="goat"><?= $this->Html->link('List Your Applications', ['prefix' => false,'controller' => 'Applications', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('List Your Attendees', ['prefix' => false, 'controller' => 'Attendees', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('List Your Invoices', ['prefix' => false, 'controller' => 'Invoices', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Show All Districts', ['prefix' => false, 'controller' => 'Districts', 'action' => 'index']); ?></td>
        </tr>
        <tr class="goat">
			<td class="goat"><?= $this->Html->link('Add a new Application', ['prefix' => false,'controller' => 'Applications', 'action' => 'add']); ?></td>
			<td class="goat"><?= $this->Html->link('Add a Young Person', ['prefix' => false, 'controller' => 'Attendees', 'action' => 'cub']); ?></td>
			<td class="goat"><?= $this->Html->link('Generate a New Invoice', ['prefix' => false, 'controller' => 'Invoices', 'action' => 'generate']); ?></td>
			<td class="goat"><?= $this->Html->link('Show All Scout Groups', ['prefix' => false, 'controller' => 'Scoutgroups', 'action' => 'index']); ?></td>
        </tr>
        <tr class="goat">
			<td class="goat"></td>
			<td class="goat"><?= $this->Html->link('Add an Adult', ['prefix' => false, 'controller' => 'Attendees', 'action' => 'adult']); ?></td>
			<td class="goat"><?= $this->Html->link('List Your Payments', ['prefix' => false, 'controller' => 'Payments', 'action' => 'index']); ?></td>
			<td class="goat"><?= $this->Html->link('Show All Champions', ['prefix' => false, 'controller' => 'Champions', 'action' => 'index']); ?></td>
        </tr>
    </table>
</div>

<div class="landing user_home large-12 medium-12 columns content">
    <h3><?= __('Upcoming Events') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= h('Name') ?></th>
                <th><?= h('Start Date') ?></th>
                <th><?= h('End Date') ?></th>
                <th><?= h('Last Modified') ?></th>
                <th><?= h('Venue') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= h($event->name) ?></td>
                <td><?= $this->Time->i18nFormat($event->start, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($event->end, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= h($event->location) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Book onto Event'), ['controller' => 'Applications', 'action' => 'book', $event->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>