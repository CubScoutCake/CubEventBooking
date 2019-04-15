<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventType $eventType
 */
?>
<div class="eventTypes view large-9 medium-8 columns content">
    <h3><?= h($eventType->event_type) ?></h3>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Booking Methods</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p><strong><?= __('Simple Booking') ?>:</strong> <?= $eventType->simple_booking ? __('Yes') : __('No'); ?></p>
                            <p><strong><?= __('Sync Booking') ?>:</strong> <?= $eventType->sync_book ? __('Yes') : __('No'); ?></p>
                            <p><strong><?= __('Hold Booking') ?>:</strong> <?= $eventType->hold_booking ? __('Yes') : __('No'); ?></p>
                            <p><strong><?= __('Attendee Booking') ?>:</strong> <?= $eventType->attendee_booking ? __('Yes') : __('No'); ?></p>
                        </div>
                        <div class="col-lg-6">
                            <p><strong><?= __('Parent Applications') ?>:</strong> <?= $eventType->parent_applications ? __('Yes') : __('No'); ?></p>
                            <p><strong><?= __('District Booking') ?>:</strong> <?= $eventType->district_booking ? __('Yes') : __('No'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Required Fields</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p><strong><?= __('Date Of Birth') ?>:</strong> <?= $eventType->date_of_birth ? __('Yes') : __('No'); ?></p>
                            <p><strong><?= __('Medical') ?>:</strong> <?= $eventType->medical ? __('Yes') : __('No'); ?></p>
                            <p><strong><?= __('Dietary') ?>:</strong> <?= $eventType->dietary ? __('Yes') : __('No'); ?></p>
                        </div>
                        <div class="col-lg-6">
                            <p><strong><?= __('Team Leader') ?>:</strong> <?= $eventType->team_leader ? __('Yes') : __('No'); ?></p>
                            <p><strong><?= __('Permit Holder') ?>:</strong> <?= $eventType->permit_holder ? __('Yes') : __('No'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Display Options</h4>
        </div>
        <div class="panel-body">
            <p><strong><?= __('Display Availability') ?>:</strong> <?= $eventType->display_availability ? __('Yes') : __('No'); ?></p>
            <br/>
            <p><strong><?= __('Invoice Text') ?>:</strong> <?= $eventType->has('invoice_text') ? $this->Html->link($eventType->invoice_text->text, ['controller' => 'Settings', 'action' => 'view', $eventType->invoice_text->id]) : '' ?></p>
            <p><strong><?= __('Legal Text') ?>:</strong> <?= $eventType->has('legal_text') ? $this->Html->link($eventType->legal_text->text, ['controller' => 'Settings', 'action' => 'view', $eventType->legal_text->id]) : '' ?></p>
            <p><strong><?= __('Application Reference') ?>:</strong> <?= $eventType->has('application_ref') ? $this->Html->link($eventType->application_ref->text, ['controller' => 'Settings', 'action' => 'view', $eventType->application_ref->id]) : '' ?></p>
            <p><strong><?= __('Payable') ?>:</strong> <?= $eventType->has('payable') ? $this->Html->link($eventType->payable->text, ['controller' => 'Settings', 'action' => 'view', $eventType->payable->id]) : '' ?></p>
        </div>
    </div>
	<?php if (!empty($eventType->events)): ?>
    <div class="related">
        <h4><?= __('Related Events') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('ID') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Section') ?></th>
                <th scope="col"><?= __('Live') ?></th>
                <th scope="col"><?= __('New Apps') ?></th>
                <th scope="col"><?= __('Complete') ?></th>
                <th scope="col"><?= __('Team Price') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('Max Apps') ?></th>
                <th scope="col"><?= __('# Apps') ?></th>
                <th scope="col"><?= __('# Prices') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventType->events as $events): ?>
            <tr>
                <td><?= h($events->id) ?></td>
                <td><?= h($events->name) ?></td>
                <td><?= h($events->section_type_id) ?></td>
                <td><?= h($events->live) ?></td>
                <td><?= h($events->new_apps) ?></td>
                <td><?= h($events->complete) ?></td>
                <td><?= h($events->team_price) ?></td>
                <td><?= $this->Time->format($events->start_date, 'dd-MMM-yy') ?></td>
                <td><?= $this->Number->format($events->max_apps) ?></td>
                <td><?= $this->Number->format($events->cc_apps) ?></td>
                <td><?= $this->Number->format($events->cc_prices) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
