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
                    <th scope="col"><?= $this->Paginator->sort('no_money') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('reserved') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('attendees_added') ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($applicationStatuses as $applicationStatus): ?>
                    <tr>
                        <td><?= $this->Number->format($applicationStatus->id) ?></td>
                        <td><?= h($applicationStatus->application_status) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $applicationStatus->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicationStatus->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicationStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicationStatus->id)]) ?>
                        </td>
                        <td><?= $applicationStatus->active ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $applicationStatus->no_money ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $applicationStatus->reserved ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $applicationStatus->attendees_added ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>