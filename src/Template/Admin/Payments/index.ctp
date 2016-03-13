<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-gbp fa-fw"></i> Recorded Payments</h3>
        <div class="table-responsive">
            <table class="table table-hover">
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
