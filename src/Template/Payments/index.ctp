<nav class="large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="payments index large-10 medium-9 columns">
    <h3><?= __('Payments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', 'Payment Id') ?></th>
                <th><?= $this->Paginator->sort('value', 'Payment Value') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Recorded') ?></th>
                <th><?= $this->Paginator->sort('paid', 'Date Paid') ?></th>
                <th><?= $this->Paginator->sort('name_on_cheque', 'Name on Cheque') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?= $this->Number->format($payment->id) ?></td>
                <td><?= $this->Number->currency($payment->value,'GBP') ?></td>
                <td><?= $this->Time->i18nFormat($payment->created, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($payment->paid, 'dd-MMM-yy') ?></td>
                <td><?= h($payment->name_on_cheque) ?></td>
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
