<?php
/**
 * @var \App\Model\Entity\Invoice[] $invoices
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuthRole $auth_role
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-file-invoice-dollar fa-fw"></i> Your Invoices</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id','Invoice Number') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('user_id', 'User') ?></th>
                        <th><?= $this->Paginator->sort('initial_value', 'Total Invoice Value') ?></th>
                        <th><?= $this->Paginator->sort('value', 'Payments Received') ?></th>
                        <th><?= $this->Paginator->sort('Balance') ?></th>
                        <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td>Invoice #<?= $this->Number->format($invoice->id) ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fal fa-cog"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?></li>
                                    <?php if ($auth_role->user_access) : ?><li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?></li><?php endif; ?>
                                </ul>
                            </div>
                        </td>
                        <td><?= $invoice->has('user') ? $this->Html->link($invoice->user->full_name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                        <td><?= $this->Number->currency($invoice->initial_value,'GBP') ?></td>
                        <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                        <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                        <td><?= $this->Time->i18nFormat($invoice->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
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
