<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-calendar-star fa-fw"></i> Upcoming Events</h3>
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
                            <?= $this->Html->link('Book', ['action' => 'book', $event->id], ['title' => __('Book'), 'class' => 'btn btn-default']) ?>
                        </td>
                        <td><?= $this->Time->i18nFormat($event->start_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->i18nFormat($event->end_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= h($event->location) ?></td>
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
