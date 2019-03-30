<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-calendar fa-fw"></i> Upcoming Events</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= h('Name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= h('Start Date') ?></th>
                        <th><?= h('End Date') ?></th>
                        <th><?= h('Last Modified') ?></th>
                        <th><?= h('Venue') ?></th>
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
                        <td><?= $this->Time->i18nFormat($event->start_date, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nFormat($event->end_date, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= h($event->location) ?></td>
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
