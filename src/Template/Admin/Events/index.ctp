<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event[] $events
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-calendar fa-fw"></i> Upcoming Events</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= h('Name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= h('Event Status') ?></th>
                        <th><?= h('Start Date') ?></th>
                        <th><?= h('End Date') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= h($event->name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['controller' => 'Events', 'action' => 'view', $event->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $event->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-tags"></i>', ['action' => 'prices', $event->id], ['title' => __('Prices'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-chart-bar"></i>', ['action' => 'accounts', $event->id], ['title' => __('Accounts'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-inventory"></i>', ['action' => 'logistics', $event->id], ['title' => __('Logistics'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $event->has('event_status') ? h($event->event_status->event_status) : '' ?></td>
                        <td><?= $this->Time->format($event->start_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->format($event->end_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
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
