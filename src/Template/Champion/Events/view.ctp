<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Complete View'), ['action' => 'full_view', $event->id]) ?> </li>
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Discount'), ['controller' => 'Discounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Applications'), ['controller' => 'Applications', 'action' => 'bookings', $event->id]) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'book', $event->id]) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
</nav>
<div class="events view large-9 medium-8 columns content">
    <h3><?= h($event->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($event->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Full Name') ?></th>
            <td><?= h($event->full_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Location') ?></th>
            <td><?= h($event->location) ?></td>
        </tr>
        <tr>
            <th><?= __('Deposit Text') ?></th>
            <td><?= h($event->deposit_text) ?></td>
        </tr>
        <tr>
            <th><?= __('Cubs Text') ?></th>
            <td><?= h($event->cubs_text) ?></td>
        </tr>
        <tr>
            <th><?= __('Yls Text') ?></th>
            <td><?= h($event->yls_text) ?></td>
        </tr>
        <tr>
            <th><?= __('Leaders Text') ?></th>
            <td><?= h($event->leaders_text) ?></td>
        </tr>
        <tr>
            <th><?= __('Logo') ?></th>
            <td><?= h($event->logo) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($event->address) ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= h($event->city) ?></td>
        </tr>
        <tr>
            <th><?= __('County') ?></th>
            <td><?= h($event->county) ?></td>
        </tr>
        <tr>
            <th><?= __('Postcode') ?></th>
            <td><?= h($event->postcode) ?></td>
        </tr>
        <tr>
            <th><?= __('Setting') ?></th>
            <td><?= $event->has('setting') ? $this->Html->link($event->setting->name, ['controller' => 'Settings', 'action' => 'view', $event->setting->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Discount') ?></th>
            <td><?= $event->has('discount') ? $this->Html->link($event->discount->id, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Intro Text') ?></th>
            <td><?= h($event->intro_text) ?></td>
        </tr>
        <tr>
            <th><?= __('Tagline Text') ?></th>
            <td><?= h($event->tagline_text) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deposit Value') ?></th>
            <td><?= $this->Number->format($event->deposit_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Cubs Value') ?></th>
            <td><?= $this->Number->format($event->cubs_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Yls Value') ?></th>
            <td><?= $this->Number->format($event->yls_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Leaders Value') ?></th>
            <td><?= $this->Number->format($event->leaders_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Invtext Id') ?></th>
            <td><?= $this->Number->format($event->invtext_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Max Cubs') ?></th>
            <td><?= $this->Number->format($event->max_cubs) ?></td>
        </tr>
        <tr>
            <th><?= __('Max Yls') ?></th>
            <td><?= $this->Number->format($event->max_yls) ?></td>
        </tr>
        <tr>
            <th><?= __('Max Leaders') ?></th>
            <td><?= $this->Number->format($event->max_leaders) ?></td>
        </tr>
        <tr>
            <th><?= __('Start') ?></th>
            <td><?= h($event->start) ?></tr>
        </tr>
        <tr>
            <th><?= __('End') ?></th>
            <td><?= h($event->end) ?></tr>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($event->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($event->modified) ?></tr>
        </tr>
        <tr>
            <th><?= __('Deposit Date') ?></th>
            <td><?= h($event->deposit_date) ?></tr>
        </tr>
        <tr>
            <th><?= __('Deposit') ?></th>
            <td><?= $event->deposit ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Deposit Inc Leaders') ?></th>
            <td><?= $event->deposit_inc_leaders ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Cubs') ?></th>
            <td><?= $event->cubs ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Yls') ?></th>
            <td><?= $event->yls ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Leaders') ?></th>
            <td><?= $event->leaders ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Live') ?></th>
            <td><?= $event->live ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Max') ?></th>
            <td><?= $event->max ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applications') ?></h4>
        <?php if (!empty($event->applications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Scoutgroup Id') ?></th>
                <th><?= __('Event Id') ?></th>
                <th><?= __('Section') ?></th>
                <th><?= __('Permitholder') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Modification') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->applications as $applications): ?>
            <tr>
                <td><?= h($applications->id) ?></td>
                <td><?= h($applications->user_id) ?></td>
                <td><?= h($applications->scoutgroup_id) ?></td>
                <td><?= h($applications->event_id) ?></td>
                <td><?= h($applications->section) ?></td>
                <td><?= h($applications->permitholder) ?></td>
                <td><?= h($applications->created) ?></td>
                <td><?= h($applications->modified) ?></td>
                <td><?= h($applications->modification) ?></td>
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
