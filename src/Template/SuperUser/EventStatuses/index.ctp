<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventStatus[]|\Cake\Collection\CollectionInterface $eventStatuses
 */
?>

<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-signal fa-fw"></i> Event Statuses</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('event_status') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('live') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('accepting_applications') ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventStatuses as $eventStatus): ?>
                        <tr>
                            <td><?= $this->Number->format($eventStatus->id) ?></td>
                            <td><?= h($eventStatus->event_status) ?></td>
                            <td class="actions">
                                <?= $this->Html->link('', ['action' => 'view', $eventStatus->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                                <?= $this->Html->link('', ['action' => 'edit', $eventStatus->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                                <?= $this->Form->postLink('', ['action' => 'delete', $eventStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventStatus->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash-o']) ?>
                            </td>
                            <td><?= $eventStatus->live ? '<i class="fa fa-check fa-fw"></i>' : '' ?></td>
                            <td><?= $eventStatus->accepting_applications ? '<i class="fa fa-check fa-fw"></i>' : '' ?></td>
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
