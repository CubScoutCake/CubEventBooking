<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-calendar fa-fw"></i> Upcoming Events</h3>
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
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('Preview - User View'), ['action' => 'view', $event->id]) ?></li>
                                    <li><?= $this->Html->link(__('Full View - inc Bookings'), ['action' => 'full_view', $event->id]) ?></li>
                                    <li class="divider"></li>
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= $this->Time->i18nFormat($event->start, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nFormat($event->end, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-yy HH:mm') ?></td>
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
