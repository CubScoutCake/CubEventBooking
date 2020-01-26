<div class="pull-right">
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="<?php echo $this->Url->build([
                'controller' => 'Events',
                'prefix' => 'admin',
                'action' => 'view',
                $event->id],['_full']); ?>">Preview View</a>
            </li>
            <li><a href="<?php echo $this->Url->build([
                'controller' => 'Events',
                'prefix' => 'admin',
                'action' => 'view',
                $event->id],['_full']); ?>">Admin View</a>
            </li>
            <li><a href="<?php echo $this->Url->build([
                'controller' => 'Events',
                'prefix' => 'admin',
                'action' => 'edit',
                $event->id ],['_full']); ?>">Edit Event</a>
            </li>
            <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
            <li class="divider"></li>
            <li><a href="<?php echo $this->Url->build([
                'controller' => 'Applications',
                'action' => 'index',
                'prefix' => false],['_full']); ?>">Separated link</a>
            </li>
        </ul>
    </div>
</div>

<div class="events view large-10 medium-9 columns content">
    <h3><?= h($event->name) ?> - Event Number: <?= $this->Number->format($event->id) ?></h3>
    <table class="goat">
        <tr>
            <th><?= __('Property') ?></th>
            <th><?= __('Applications') ?></th>
            <th><?= __('Invoices') ?></th>
        </tr>
        <tr>
            <th><?= __('Count') ?></th>
            <td><?= $this->Number->format($cntApplications) ?></td>
            <td><?= $this->Number->format($cntInvoices) ?></td>
        </tr>
    <?php if ($cntInvoices > 1 || $cntApplications > 1) : ?>
        <tr>
            <th><?= __('Total Income') ?></th>
            <td></td>
            <td><?= $this->Number->currency($sumValues,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Total Payments') ?></th>
            <td></td>
            <td><?= $this->Number->currency($sumPayments,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Total Outstanding Balances') ?></th>
            <td></td>
            <td><?= $this->Number->currency($sumBalances,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Cubs') ?></th>
            <td><?= $this->Number->format($appCubs) ?></td>
            <td><?= $this->Number->format($invCubs) ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Young Leaders') ?></th>
            <td><?= $this->Number->format($appYls) ?></td>
            <td><?= $this->Number->format($invYls) ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Leaders') ?></th>
            <td><?= $this->Number->format($appLeaders) ?></td>
            <td><?= $this->Number->format($invLeaders) ?></td>
        </tr>
    <?php endif; ?>
    </table>
</div>

<div class="events view large-10 medium-9 columns content">
    <h4>Event Details</h4>
    <table class="goat">
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
    </table>

    <table class="goat">
        <tr>
            <th><?= $event->live ? __('Event is Live') : __('Event is Hidden'); ?></th>
            <th><?= $event->max ? __('Numbers Limited') : __('Numbers Not Limited'); ?></th>
            <th><?= $event->allow_reductions ? __('Invoices can be Reduced') : __('Invoices can only be Increased'); ?></th>
        </tr>
        <tr>
            <th><?= $event->invoices_locked ? __('Invoices are Locked') : __('Invoices can be Updated'); ?></th>
            <th><?= $event->parent_applications ? __('Parent Applications Available') : __('Parent Applications Unavailable'); ?></th>
            <th><?php if (isset($event->available_apps) && isset($event->available_cubs)) {
                    echo 'Available Cubs & Apps Limited';
                } elseif (isset($event->available_cubs)) {
                    echo 'Available Cubs Limited';
                } elseif (isset($event->available_apps)) {
                    echo 'Available Apps Limited';
                } else {
                   echo 'Available Cubs & Apps Unlimited';
                }  ?></th>
        </tr>
    </table>

    <table class="goat">
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($event->admin_user->full_name) ?></td>
            <th><?= __('Deposit Required') ?></th>
            <td><?= $event->deposit ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?= h($event->address) ?></td>
            <th><?= __('Deposit Date') ?></th>
            <td><?= $this->Time->i18nFormat($event->deposit_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
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
            <td><?= $this->Time->i18nFormat($event->start, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
            <th><?= __('Date Created') ?></th>
            <td><?= $this->Time->i18nFormat($event->created, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
        </tr>
        <tr>
            <th><?= __('Event End') ?></th>
            <td><?= $this->Time->i18nFormat($event->end, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
            <th><?= __('Date Modified') ?></th>
            <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
        </tr>
        <tr>
            <th><?= __('Invtext Id') ?></th>
            <td><?= h($invText->text) ?></td>
            <th><?= __('Legal Text') ?></th>
            <td><?= $event->has('setting') ? $this->Html->link($event->setting->text, ['controller' => 'Settings', 'action' => 'view', $event->setting->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Discount') ?></th>
            <td><?= $event->has('discount') ? $this->Html->link($event->discount->text, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : 'None' ?></td>
            <td><?= $event->has('discount') ? __('(') . $this->Number->currency($event->discount->discount_value,'GBP') . __(')') : '' ?></td>
            <td><?= $event->has('discount') ? __('1 : ') . $this->Number->format($event->discount->discount_number) : '' ?></td>
        </tr>
        <?php if (isset($event->available_apps) || isset($event->available_cubs)) : ?>
            <tr>
                <th><?= __('Maximum Total Applications') ?></th>

                <td><?php if (isset($event->available_apps) && $event->available_apps > 0)
                    { echo $this->Number->format($event->available_apps); }
                else
                    { echo 'Unlimited'; } ?></td>

                <th><?= __('Maximum Total Cubs') ?></th>

                <td><?php if (isset($event->available_cubs) && $event->available_cubs > 0)
                    { echo $this->Number->format($event->available_cubs); }
                else
                    { echo 'Unlimited'; } ?></td>
            </tr>
        <?php endif ?>
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
    <table class="goat">
        <tr>
            <th><?= __('Contact Person') ?></th>
            <td><?= $this->Html->link($administrator->full_name, ['controller' => 'Users', 'action' => 'view', $administrator->id]) ?></td>
            <td><?= $this->Text->autoLink($event->admin_email) ?></td>
            <td><?= h($administrator->phone) ?></td>
        </tr>
    </table>

    </table>
    <div class="related">
        <h4><?= __('Related Applications') ?></h4>
        <?php if (!empty($event->applications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User') ?></th>
                <th><?= __('Scoutgroup') ?></th>
                <th><?= __('Section') ?></th>
                <th><?= __('Permitholder') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($event->applications as $applications): ?>
            <tr>
                <td><?= h($applications->display_code) ?></td>
                <td><?= $applications->has('user') ? $this->Html->link($this->Text->truncate($applications->user->full_name,18), ['controller' => 'Users', 'action' => 'view','prefix' => 'admin', $applications->user->id]) : '' ?></td>
                <td><?= $applications->has('scoutgroup') ? $this->Html->link($this->Text->truncate($applications->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroup', 'action' => 'view','prefix' => 'admin', $applications->scoutgroup->id]) : '' ?></td>
                <td><?= h($applications->section) ?></td>
                <td><?= h($applications->permitholder) ?></td>
                <td><?= h($applications->created) ?></td>
                <td><?= h($applications->modified) ?></td>
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
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Application') ?></th>
                <th><?= __('Sum Value') ?></th>
                <th><?= __('Received') ?></th>
                <th><?= __('Balance') ?></th>
                <th><?= __('Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= h($invoice->id) ?></td>
                <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
                <td><?= $this->Number->currency($invoice->initial_value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                <td><?= $this->Time->i18nFormat($invoice->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?>
                    <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
