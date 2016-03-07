<nav class="actions large-2 medium-3 columns" id="actions-sidebar">

<?= $this->start('Sidebar');
echo $this->element('Sidebar/start');
echo $this->element('Sidebar/user');
echo $this->element('Sidebar/end');
$this->end(); ?>

<?= $this->fetch('Sidebar') ?>

</nav>
<div class="invoices index large-10 medium-9 columns content">
    <h3><?= __('Payment Invoices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id','Invoice Number') ?></th>
                <th><?= $this->Paginator->sort('user_id', 'User ID') ?></th>
                <th><?= $this->Paginator->sort('initialvalue', 'Total Invoice Value') ?></th>
                <th><?= $this->Paginator->sort('value', 'Payments Received') ?></th>
                <th><?= $this->Paginator->sort('Balance') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td>Invoice #<?= $this->Number->format($invoice->id) ?></td>
                <td><?= $invoice->has('user') ? $this->Html->link($this->Text->truncate($invoice->user->username,18), ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-yy HH:mm') ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?>
                    <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?>
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
