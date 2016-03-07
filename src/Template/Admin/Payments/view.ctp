<nav class="actions large-2 medium-2 columns" id="actions-sidebar">
    
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Notify'), ['prefix' => 'admin', 'controller' => 'Notifications', 'action' => 'notify_payment', $payment->id]) ?></li>
        <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin', 'controller' => 'Payments', 'action' => 'edit', $payment->id]) ?></li>
        <li><?= $this->Html->link(__('New'), ['prefix' => 'admin', 'controller' => 'Payments', 'action' => 'add']) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="payments view large-10 medium-10 columns content">
    <h3><?= h($payment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($payment->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= $this->Number->currency($payment->value,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Time->i18nformat($payment->created,'dd-MMM-yy HH:mm') ?></tr>
        </tr>
        <tr>
            <th><?= __('Paid') ?></th>
            <td><?= $this->Time->i18nformat($payment->paid,'dd-MMM-yy HH:mm') ?></tr>
        </tr>
        <tr>
            <th><?= __('Cheque Number') ?></th>
            <td><?= h($payment->cheque_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Name on Cheque') ?></th>
            <td><?= h($payment->name_on_cheque) ?></td>
        </tr>
        <tr>
            <th><?= __('Recorded By') ?></th>
            <td><?= $payment->has('user') ? $this->Html->link($this->Text->truncate($payment->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($payment->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User') ?></th>
                <th><?= __('Sum Value') ?></th>
                <th><?= __('Received') ?></th>
                <th><?= __('Balance') ?></th>
                <th><?= __('Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($payment->invoices as $invoices): ?>
            <tr>
                <td><?= $this->Html->link($invoices->display_code, ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?></td>
                <td><?= $invoices->has('user') ? $this->Html->link($this->Text->truncate($invoices->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $invoices->user->id]) : '' ?></td>
                <td><?= $this->Number->currency($invoices->initialvalue,'GBP') ?></td>
                <td><?= $this->Number->currency($invoices->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoices->balance,'GBP') ?></td>
                <td><?= $this->Time->i18nformat($invoices->created,'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
