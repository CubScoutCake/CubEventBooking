<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-calendar-alt fa-fw"></i> Event Types</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id'); ?></th>
                    <th><?= $this->Paginator->sort('event_type'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
                    <th><?= $this->Paginator->sort('simple_booking'); ?></th>
                    <th><?= $this->Paginator->sort('date_of_birth'); ?></th>
                    <th><?= $this->Paginator->sort('medical'); ?></th>
                    <th><?= $this->Paginator->sort('parent_applications'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($eventTypes as $eventType): ?>
                    <tr>
                        <td><?= $this->Number->format($eventType->id) ?></td>
                        <td><?= h($eventType->event_type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $eventType->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $eventType->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $eventType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventType->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= h($eventType->simple_booking ? __('Yes') : __('')) ?></td>
                        <td><?= h($eventType->date_of_birth ? __('Yes') : __('')) ?></td>
                        <td><?= h($eventType->medical  ? __('Yes') : __('')) ?></td>
                        <td><?= h($eventType->parent_applications ? __('Yes') : __('')) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>
