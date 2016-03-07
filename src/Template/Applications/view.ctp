<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Index'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Young Person'), ['controller' => 'Attendees', 'action' => 'cub']) ?></li>
        <li><?= $this->Html->link(__('New Adult'), ['controller' => 'Attendees', 'action' => 'adult']) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="applications view large-10 medium-9 columns content">
    <h3><?= h($application->display_code) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $application->has('user') ? $this->Html->link($application->user->username, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Scoutgroup') ?></th>
            <td><?= $application->has('scoutgroup') ? $this->Html->link($application->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Section') ?></th>
            <td><?= h($application->section) ?></td>
        </tr>
        <tr>
            <th><?= __('Event') ?></th>
            <td><?= $application->has('event') ? $this->Html->link($application->event->full_name, ['controller' => 'Events', 'action' => 'view', $application->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($application->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Permitholder') ?></th>
            <td><?= h($application->permitholder) ?></td>
        </tr>
        <tr>
            <th><?= __('Date Created') ?></th>
            <td><?= $this->Time->i18nFormat($application->created, 'dd-MMM-yy HH:mm') ?></tr>
        </tr>
        <tr>
            <th><?= __('Last Modified') ?></th>
            <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Attendees') ?></h4>
        <?php if (!empty($application->attendees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('firstname') ?></th>
                <th><?= __('lastname') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($application->attendees as $attendees): ?>
            <tr>
                <td><?= h($attendees->firstname) ?></td>
                <td><?= h($attendees->lastname) ?></td>
                <td><?= $this->Time->i18nFormat($attendees->created, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($application->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Sum Value') ?></th>
                <th><?= __('Received') ?></th>
                <th><?= __('Balance') ?></th>
                <th><?= __('Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($application->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->id) ?></td>
                <td><?= h($invoices->user_id) ?></td>
                <td><?= $this->Number->currency($invoices->initialvalue,'GBP') ?></td>
                <td><?= $this->Number->currency($invoices->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoices->balance,'GBP') ?></td>
                <td><?= $this->Time->i18nformat($invoices->created,'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>

                    <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoices->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
