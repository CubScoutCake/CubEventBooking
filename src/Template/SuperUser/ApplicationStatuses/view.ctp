<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationStatus $applicationStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Application Status'), ['action' => 'edit', $applicationStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Application Status'), ['action' => 'delete', $applicationStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicationStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Application Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicationStatuses view large-9 medium-8 columns content">
    <h3><?= h($applicationStatus->application_status) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Application Status') ?></th>
            <td><?= h($applicationStatus->application_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicationStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $applicationStatus->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('No Money') ?></th>
            <td><?= $applicationStatus->no_money ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reserved') ?></th>
            <td><?= $applicationStatus->reserved ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attendees Added') ?></th>
            <td><?= $applicationStatus->attendees_added ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applications') ?></h4>
        <?php if (!empty($applicationStatus->applications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Legacy Section') ?></th>
                <th scope="col"><?= __('Permit Holder') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modification') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Osm Event Id') ?></th>
                <th scope="col"><?= __('Cc Att Total') ?></th>
                <th scope="col"><?= __('Cc Att Cubs') ?></th>
                <th scope="col"><?= __('Cc Att Yls') ?></th>
                <th scope="col"><?= __('Cc Att Leaders') ?></th>
                <th scope="col"><?= __('Cc Inv Count') ?></th>
                <th scope="col"><?= __('Cc Inv Total') ?></th>
                <th scope="col"><?= __('Cc Inv Cubs') ?></th>
                <th scope="col"><?= __('Cc Inv Yls') ?></th>
                <th scope="col"><?= __('Cc Inv Leaders') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col"><?= __('Team Leader') ?></th>
                <th scope="col"><?= __('Application Status Id') ?></th>
                <th scope="col"><?= __('Hold Numbers') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($applicationStatus->applications as $applications): ?>
            <tr>
                <td><?= h($applications->id) ?></td>
                <td><?= h($applications->user_id) ?></td>
                <td><?= h($applications->legacy_section) ?></td>
                <td><?= h($applications->permit_holder) ?></td>
                <td><?= h($applications->created) ?></td>
                <td><?= h($applications->modified) ?></td>
                <td><?= h($applications->modification) ?></td>
                <td><?= h($applications->event_id) ?></td>
                <td><?= h($applications->osm_event_id) ?></td>
                <td><?= h($applications->cc_att_total) ?></td>
                <td><?= h($applications->cc_att_cubs) ?></td>
                <td><?= h($applications->cc_att_yls) ?></td>
                <td><?= h($applications->cc_att_leaders) ?></td>
                <td><?= h($applications->cc_inv_count) ?></td>
                <td><?= h($applications->cc_inv_total) ?></td>
                <td><?= h($applications->cc_inv_cubs) ?></td>
                <td><?= h($applications->cc_inv_yls) ?></td>
                <td><?= h($applications->cc_inv_leaders) ?></td>
                <td><?= h($applications->deleted) ?></td>
                <td><?= h($applications->section_id) ?></td>
                <td><?= h($applications->team_leader) ?></td>
                <td><?= h($applications->application_status_id) ?></td>
                <td><?= h($applications->hold_numbers) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
