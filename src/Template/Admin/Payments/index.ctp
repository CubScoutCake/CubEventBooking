<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-receipt fa-fw"></i> Recorded Payments</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', 'Payment Id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
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
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fal fa-cog"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $payment->id]) ?></li>
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $payment->id]) ?></li>
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?></li>
                                    <li class="divider"></li>
                                    <li><?= $this->Html->link(__('Notify'), ['controller' => 'Notifications', 'action' => 'notify_payment', $payment->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= $this->Number->currency($payment->value,'GBP') ?></td>
                        <td><?= $this->Time->i18nFormat($payment->created, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->i18nFormat($payment->paid, 'dd-MMM-yy') ?></td>
                        <td><?= h($payment->name_on_cheque) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                        Showing page <?= $this->Paginator->counter() ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_paginate paginatior paging_simple_numbers" id="dataTables-example_paginate">
                        <ul class="pagination">
                            <?= $this->Paginator->prev(__('Previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('Next')) ?>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
