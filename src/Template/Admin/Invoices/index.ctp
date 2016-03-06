<div class="actions invoices index large-12 medium-12 columns">
    <h3><?= __('Payment Invoices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id','Invoice Number') ?></th>
                <th><?= $this->Paginator->sort('user_id', 'User') ?></th>
                <th><?= $this->Paginator->sort('application_id', 'Application') ?></th>
                <th><?= $this->Paginator->sort('initialvalue', 'Total Invoice Value') ?></th>
                <th><?= $this->Paginator->sort('value', 'Payments Received') ?></th>
                <th><?= $this->Paginator->sort('balance') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td>Invoice #<?= $this->Number->format($invoice->id) ?></td>
                <td><?= $invoice->has('user') ? $this->Html->link($this->Text->truncate($invoice->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
                <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-yy HH:mm') ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?>
                    <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id, $invoice->user_id]) ?>
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
