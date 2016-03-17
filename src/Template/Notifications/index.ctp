<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-bell-o fa-fw"></i> Your Notifications</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('new', 'Read') ?></th>
                        <th><?= $this->Paginator->sort('notificationtype_id', 'Type') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($notifications as $notification): ?>
                        <tr <?= $notification->new ? __('class="info"') : __(''); ?>>
                            <td><?= $this->Number->format($notification->id) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'prefix' => false, 'action' => 'view', $notification->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'prefix' => false, 'action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= $notification->new ? __('No') : __('Yes'); ?></td>
                            <td><?= $notification->has('notificationtype') ? h($notification->notificationtype->notification_type) : '' ?></td>
                            <td><?= h($notification->created) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
=======
<?= $this->assign('title', 'All Your Notifications'); ?>
<nav class="actions notifications large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <h3 class="heading"><?= __('Actions') ?></h3>
        <li><?= $this->Html->link(__('List Your Unread Notifications'), ['action' => 'unread']) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="notifications index large-10 medium-9 columns content">
    <h3><?= __('Notifications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('notificationtype_id', 'Type') ?></th>
                <th><?= $this->Paginator->sort('new', 'Read') ?></th>
                <th><?= $this->Paginator->sort('notification_header', 'Header') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach ($notifications as $notification): ?>
            <tr>
                <td><?= $this->Number->format($notification->id) ?></td>
                <td><?= $notification->has('user') ? $this->Html->link($notification->user->full_name, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
                <td><?= $notification->has('notificationtype') ? $this->Html->link($notification->notificationtype->notification_type, ['controller' => 'Notificationtypes', 'action' => 'view', $notification->notificationtype->id]) : '' ?></td>
                <td><?= $notification->new ? __('No') : __('Yes'); ?></td>
                <td><?= h($notification->notification_header) ?></td>
                <td><?= h($notification->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'prefix' => false, 'action' => 'view', $notification->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'prefix' => false, 'action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
>>>>>>> master
    </div>
</div>
