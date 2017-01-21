<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Event Type'), ['action' => 'edit', $eventType->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Event Type'), ['action' => 'delete', $eventType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventType->id)]) ?> </li>
<li><?= $this->Html->link(__('List Event Types'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Event Type'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Event Type'), ['action' => 'edit', $eventType->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Event Type'), ['action' => 'delete', $eventType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventType->id)]) ?> </li>
<li><?= $this->Html->link(__('List Event Types'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Event Type'), ['action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?> </li>
<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($eventType->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Event Type') ?></td>
            <td><?= h($eventType->event_type) ?></td>
        </tr>
        <tr>
            <td><?= __('Setting') ?></td>
            <td><?= $eventType->has('setting') ? $this->Html->link($eventType->setting->name, ['controller' => 'Settings', 'action' => 'view', $eventType->setting->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($eventType->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Invoice Text Id') ?></td>
            <td><?= $this->Number->format($eventType->invoice_text_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Simple Booking') ?></td>
            <td><?= $eventType->simple_booking ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Date Of Birth') ?></td>
            <td><?= $eventType->date_of_birth ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Medical') ?></td>
            <td><?= $eventType->medical ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Parent Applications') ?></td>
            <td><?= $eventType->parent_applications ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Events') ?></h3>
    </div>
    <?php if (!empty($eventType->events)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Full Name') ?></th>
                <th><?= __('Live') ?></th>
                <th><?= __('New Apps') ?></th>
                <th><?= __('Start Date') ?></th>
                <th><?= __('End Date') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deposit') ?></th>
                <th><?= __('Deposit Date') ?></th>
                <th><?= __('Deposit Value') ?></th>
                <th><?= __('Deposit Inc Leaders') ?></th>
                <th><?= __('Deposit Text') ?></th>
                <th><?= __('Cubs') ?></th>
                <th><?= __('Cubs Value') ?></th>
                <th><?= __('Cubs Text') ?></th>
                <th><?= __('Yls') ?></th>
                <th><?= __('Yls Value') ?></th>
                <th><?= __('Yls Text') ?></th>
                <th><?= __('Leaders') ?></th>
                <th><?= __('Leaders Value') ?></th>
                <th><?= __('Leaders Text') ?></th>
                <th><?= __('Logo') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('City') ?></th>
                <th><?= __('County') ?></th>
                <th><?= __('Postcode') ?></th>
                <th><?= __('Invtext Id') ?></th>
                <th><?= __('Legaltext Id') ?></th>
                <th><?= __('Discount Id') ?></th>
                <th><?= __('Intro Text') ?></th>
                <th><?= __('Tagline Text') ?></th>
                <th><?= __('Location') ?></th>
                <th><?= __('Max') ?></th>
                <th><?= __('Max Cubs') ?></th>
                <th><?= __('Max Yls') ?></th>
                <th><?= __('Max Leaders') ?></th>
                <th><?= __('Allow Reductions') ?></th>
                <th><?= __('Logo Ratio') ?></th>
                <th><?= __('Invoices Locked') ?></th>
                <th><?= __('Admin Firstname') ?></th>
                <th><?= __('Admin Lastname') ?></th>
                <th><?= __('Admin Email') ?></th>
                <th><?= __('Admin User Id') ?></th>
                <th><?= __('Parent Applications') ?></th>
                <th><?= __('Available Apps') ?></th>
                <th><?= __('Available Cubs') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Event Type Id') ?></th>
                <th><?= __('Section Type Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($eventType->events as $events): ?>
                <tr>
                    <td><?= h($events->id) ?></td>
                    <td><?= h($events->name) ?></td>
                    <td><?= h($events->full_name) ?></td>
                    <td><?= h($events->live) ?></td>
                    <td><?= h($events->new_apps) ?></td>
                    <td><?= h($events->start_date) ?></td>
                    <td><?= h($events->end_date) ?></td>
                    <td><?= h($events->created) ?></td>
                    <td><?= h($events->modified) ?></td>
                    <td><?= h($events->deposit) ?></td>
                    <td><?= h($events->deposit_date) ?></td>
                    <td><?= h($events->deposit_value) ?></td>
                    <td><?= h($events->deposit_inc_leaders) ?></td>
                    <td><?= h($events->deposit_text) ?></td>
                    <td><?= h($events->cubs) ?></td>
                    <td><?= h($events->cubs_value) ?></td>
                    <td><?= h($events->cubs_text) ?></td>
                    <td><?= h($events->yls) ?></td>
                    <td><?= h($events->yls_value) ?></td>
                    <td><?= h($events->yls_text) ?></td>
                    <td><?= h($events->leaders) ?></td>
                    <td><?= h($events->leaders_value) ?></td>
                    <td><?= h($events->leaders_text) ?></td>
                    <td><?= h($events->logo) ?></td>
                    <td><?= h($events->address) ?></td>
                    <td><?= h($events->city) ?></td>
                    <td><?= h($events->county) ?></td>
                    <td><?= h($events->postcode) ?></td>
                    <td><?= h($events->invtext_id) ?></td>
                    <td><?= h($events->legaltext_id) ?></td>
                    <td><?= h($events->discount_id) ?></td>
                    <td><?= h($events->intro_text) ?></td>
                    <td><?= h($events->tagline_text) ?></td>
                    <td><?= h($events->location) ?></td>
                    <td><?= h($events->max) ?></td>
                    <td><?= h($events->max_cubs) ?></td>
                    <td><?= h($events->max_yls) ?></td>
                    <td><?= h($events->max_leaders) ?></td>
                    <td><?= h($events->allow_reductions) ?></td>
                    <td><?= h($events->logo_ratio) ?></td>
                    <td><?= h($events->invoices_locked) ?></td>
                    <td><?= h($events->admin_firstname) ?></td>
                    <td><?= h($events->admin_lastname) ?></td>
                    <td><?= h($events->admin_email) ?></td>
                    <td><?= h($events->admin_user_id) ?></td>
                    <td><?= h($events->parent_applications) ?></td>
                    <td><?= h($events->available_apps) ?></td>
                    <td><?= h($events->available_cubs) ?></td>
                    <td><?= h($events->deleted) ?></td>
                    <td><?= h($events->event_type_id) ?></td>
                    <td><?= h($events->section_type_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'Events', 'action' => 'view', $events->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'Events', 'action' => 'edit', $events->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Events</p>
    <?php endif; ?>
</div>
