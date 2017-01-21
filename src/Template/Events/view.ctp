<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Discounts'), ['controller' => 'Discounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discount'), ['controller' => 'Discounts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($event->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Full Name') ?></th>
            <td><?= h($event->full_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deposit Text') ?></th>
            <td><?= h($event->deposit_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cubs Text') ?></th>
            <td><?= h($event->cubs_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Yls Text') ?></th>
            <td><?= h($event->yls_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Leaders Text') ?></th>
            <td><?= h($event->leaders_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?= h($event->logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($event->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($event->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('County') ?></th>
            <td><?= h($event->county) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postcode') ?></th>
            <td><?= h($event->postcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount') ?></th>
            <td><?= $event->has('discount') ? $this->Html->link($event->discount->discount, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Intro Text') ?></th>
            <td><?= h($event->intro_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tagline Text') ?></th>
            <td><?= h($event->tagline_text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= h($event->location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Firstname') ?></th>
            <td><?= h($event->admin_firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Lastname') ?></th>
            <td><?= h($event->admin_lastname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Email') ?></th>
            <td><?= h($event->admin_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $event->has('user') ? $this->Html->link($event->user->full_name, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deposit Value') ?></th>
            <td><?= $this->Number->format($event->deposit_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cubs Value') ?></th>
            <td><?= $this->Number->format($event->cubs_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Yls Value') ?></th>
            <td><?= $this->Number->format($event->yls_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Leaders Value') ?></th>
            <td><?= $this->Number->format($event->leaders_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invtext Id') ?></th>
            <td><?= $this->Number->format($event->invtext_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Legaltext Id') ?></th>
            <td><?= $this->Number->format($event->legaltext_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Cubs') ?></th>
            <td><?= $this->Number->format($event->max_cubs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Yls') ?></th>
            <td><?= $this->Number->format($event->max_yls) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Leaders') ?></th>
            <td><?= $this->Number->format($event->max_leaders) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo Ratio') ?></th>
            <td><?= $this->Number->format($event->logo_ratio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available Apps') ?></th>
            <td><?= $this->Number->format($event->available_apps) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available Cubs') ?></th>
            <td><?= $this->Number->format($event->available_cubs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Type Id') ?></th>
            <td><?= $this->Number->format($event->event_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Section Type Id') ?></th>
            <td><?= $this->Number->format($event->section_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($event->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($event->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($event->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deposit Date') ?></th>
            <td><?= h($event->deposit_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($event->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Live') ?></th>
            <td><?= $event->live ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('New Apps') ?></th>
            <td><?= $event->new_apps ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deposit') ?></th>
            <td><?= $event->deposit ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deposit Inc Leaders') ?></th>
            <td><?= $event->deposit_inc_leaders ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cubs') ?></th>
            <td><?= $event->cubs ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Yls') ?></th>
            <td><?= $event->yls ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Leaders') ?></th>
            <td><?= $event->leaders ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max') ?></th>
            <td><?= $event->max ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Allow Reductions') ?></th>
            <td><?= $event->allow_reductions ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoices Locked') ?></th>
            <td><?= $event->invoices_locked ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Applications') ?></th>
            <td><?= $event->parent_applications ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Settings') ?></h4>
        <?php if (!empty($event->settings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Text') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Setting Type Id') ?></th>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->settings as $settings): ?>
            <tr>
                <td><?= h($settings->id) ?></td>
                <td><?= h($settings->name) ?></td>
                <td><?= h($settings->text) ?></td>
                <td><?= h($settings->created) ?></td>
                <td><?= h($settings->modified) ?></td>
                <td><?= h($settings->event_id) ?></td>
                <td><?= h($settings->setting_type_id) ?></td>
                <td><?= h($settings->number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Settings', 'action' => 'view', $settings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Settings', 'action' => 'edit', $settings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Settings', 'action' => 'delete', $settings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $settings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Applications') ?></h4>
        <?php if (!empty($event->applications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Legacy Section') ?></th>
                <th scope="col"><?= __('Permitholder') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modification') ?></th>
                <th scope="col"><?= __('Eventname') ?></th>
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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->applications as $applications): ?>
            <tr>
                <td><?= h($applications->id) ?></td>
                <td><?= h($applications->user_id) ?></td>
                <td><?= h($applications->legacy_section) ?></td>
                <td><?= h($applications->permitholder) ?></td>
                <td><?= h($applications->created) ?></td>
                <td><?= h($applications->modified) ?></td>
                <td><?= h($applications->modification) ?></td>
                <td><?= h($applications->eventname) ?></td>
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
    <div class="related">
        <h4><?= __('Related Logistics') ?></h4>
        <?php if (!empty($event->logistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Parameter Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Header') ?></th>
                <th scope="col"><?= __('Text') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->logistics as $logistics): ?>
            <tr>
                <td><?= h($logistics->id) ?></td>
                <td><?= h($logistics->parameter_id) ?></td>
                <td><?= h($logistics->event_id) ?></td>
                <td><?= h($logistics->header) ?></td>
                <td><?= h($logistics->text) ?></td>
                <td><?= h($logistics->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Logistics', 'action' => 'view', $logistics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Logistics', 'action' => 'edit', $logistics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Logistics', 'action' => 'delete', $logistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logistics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
