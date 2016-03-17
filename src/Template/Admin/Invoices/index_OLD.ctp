<nav class="large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="invoices index large-10 medium-9 columns">
    <h3><?= __('Payment Invoices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Inv ID') ?></th>
                <th><?= $this->Paginator->sort('User') ?></th>
                <th><?= $this->Paginator->sort('Created') ?></th>
                <th><?= $this->Paginator->sort('initialvalue') ?></th>
                <th><?= $this->Paginator->sort('value') ?></th>
                <th><?= $this->Paginator->sort('balance') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td>Invoice #<?= $this->Number->format($invoice->id) ?></td>
                <td><?= $invoice->has('user') ? $this->Html->link($this->Text->truncate($invoice->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invoice->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoice->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
