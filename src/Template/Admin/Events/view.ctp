<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <h3 class="heading"><?= __('Actions') ?></h3>
        <li><?= $this->Html->link(__('View Complete'), ['action' => 'full_view', $event->id]) ?> </li>
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

<div class="events view large-10 medium-9 columns content">
    <h3><?= h($event->name) ?></h3>
    <table class="goat">
        <tr>
            <th><?= __('Full Name') ?></th>
            <td><?= h($event->full_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Location') ?></th>
            <td><?= h($event->location) ?></td>
        </tr>
        <tr>
            <th><?= __('Tagline Text') ?></th>
            <td></td>
        </tr>
    </table>

    <table class="goat">
        <tr>
            <th><?= __('Contact Person') ?></th>
            <td><?= h($event->admin_full_name) ?></td>
            <td><?= $this->Text->autoLink($event->admin_email) ?></td>
        </tr>
    </table>

    <table class="goat">
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($event->admin_full_name) ?></td>
            <th><?= __('Deposit Required') ?></th>
            <td><?= $event->deposit ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?= h($event->address) ?></td>
            <th><?= __('Deposit Date') ?></th>
            <td><?= $this->Time->i18nFormat($event->deposit_date, 'dd-MMM-yy HH:mm') ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?= h($event->city) ?></td>
            <th><?= __('Deposit Value') ?></th>
            <td><?= $this->Number->currency($event->deposit_value,'GBP') ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?= h($event->county) ?></td>
            <th><?= __('Deposit Invoice Text') ?></th>
            <td><?= h($event->deposit_text) ?></td>
        </tr>
        <tr>
            <th></th>
            <td><?= h($event->postcode) ?></td>
            <th><?= __('Deposit Inc Leaders') ?></th>
            <td><?= $event->deposit_inc_leaders ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Event Start') ?></th>
            <td><?= $this->Time->i18nFormat($event->start, 'dd-MMM-yy HH:mm') ?></td>
            <th><?= __('Date Created') ?></th>
            <td><?= $this->Time->i18nFormat($event->created, 'dd-MMM-yy HH:mm') ?></td>
        </tr>
        <tr>
            <th><?= __('Event End') ?></th>
            <td><?= $this->Time->i18nFormat($event->end, 'dd-MMM-yy HH:mm') ?></td>
            <th><?= __('Date Modified') ?></th>
            <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-yy HH:mm') ?></td>
        </tr>
        <tr>
            <th><?= __('Discount') ?></th>
            <td><?= $event->has('discount') ? $this->Html->link($event->discount->text, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : 'None' ?></td>
            <td><?= $event->has('discount') ? __('(') . $this->Number->currency($event->discount->discount_value,'GBP') . __(')') : '' ?></td>
            <td><?= $event->has('discount') ? __('1 : ') . $this->Number->format($event->discount->discount_number) : '' ?></td>
        </tr>
    </table>

    <p><strong><?= h($event->tagline_text) ?></strong></p>

    <table class="goat">
        <tr>
            <th><?= $this->Html->image($event->logo, ['alt' => $event->alt_text, 'height' => $logoHeight, 'width' => $logoWidth]); ?></th>
            <td><p><?= h($event->intro_text) ?></p></td>
        </tr>
    </table>
    <table class="goat">
        <tr>
            <th><?= __('Attendee Type'); ?></th>
            <th><?= __('Booking Permited'); ?></th>
            <th><?= __('Max Number'); ?></th>
            <th><?= __('Price'); ?></th>
            <th><?= __('Invoice Text'); ?></th>
        </tr>
        <tr>
            <td><?= __('Cubs'); ?></td>
            <td><?= $event->cubs ? __('Yes') : __('No'); ?></td>
            <td><?= $this->Number->format($event->max_cubs) ?></td>
            <td><?= $this->Number->currency($event->cubs_value,'GBP') ?></td>
            <td><?= h($event->cubs_text) ?></td>
        </tr>
        <tr>
            <td><?= __('Young Leaders'); ?></td>
            <td><?= $event->yls ? __('Yes') : __('No'); ?></td>
            <td><?= $this->Number->format($event->max_yls) ?></td>
            <td><?= $this->Number->currency($event->yls_value,'GBP') ?></td>
            <td><?= h($event->yls_text) ?></td>
        </tr>
        <tr>
            <td><?= __('Leaders'); ?></td>
            <td><?= $event->leaders ? __('Yes') : __('No'); ?></td>
            <td><?= $this->Number->format($event->max_leaders) ?></td>
            <td><?= $this->Number->currency($event->leaders_value,'GBP') ?></td>
            <td><?= h($event->leaders_text) ?></td>
        </tr>
    </table>
</div>
