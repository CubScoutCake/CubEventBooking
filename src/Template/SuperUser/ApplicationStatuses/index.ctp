<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationStatus[]|\Cake\Collection\CollectionInterface $applicationStatuses
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-thermometer fa-fw"></i> Application Statuses</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('application_status') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($applicationStatuses as $applicationStatus): ?>
                        <tr>
                            <td><?= $this->Number->format($applicationStatus->id) ?></td>
                            <td><?= h($applicationStatus->application_status) ?></td>
                            <td class="actions">
                                <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $applicationStatus->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                                <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $applicationStatus->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                                <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $applicationStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicationStatus->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            </td>
                            <td><?= $applicationStatus->active ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
				<?= $this->Paginator->prev('< ' . __('previous')) ?>
				<?= $this->Paginator->numbers() ?>
				<?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>