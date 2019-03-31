<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-check-circle fa-fw"></i> User Tasks</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('completed') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('task_type_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('date_completed') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('completed_by_user_id', 'Completed By') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task->completed ? '<i class="fal fa-2x fa-check-circle"></i>' : '<i class="fal fa-2x fa-circle"></i>' ?></td>
                        <td><?= h($task->task_type->task_type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $task->id], ['title' => __('Book'), 'class' => 'btn btn-default']) ?>
                            <?= $task->completed ? '' : $this->Html->link('Do Task', ['action' => 'complete', $task->id], ['title' => __('Book'), 'class' => 'btn btn-default']) ?>
                        </td>
                        <td><?= $this->Time->i18nFormat($task->created, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nFormat($task->date_completed, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $task->has('completing_user') ? h($task->completing_user->full_name) : '' ?></td>
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
