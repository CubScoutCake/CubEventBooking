<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($eventType->event_type) ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?= __('Event Type') ?></td>
                        <td><?= h($eventType->event_type) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Id') ?></td>
                        <td><?= $this->Number->format($eventType->id) ?></td>
                    </tr>
                </table>
                <hr>
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?= __('Legal Text') ?></td>
                        <td><?= $eventType->has('legal_text') ? $this->Html->link($eventType->legal_text->name, ['controller' => 'Settings', 'action' => 'view', $eventType->legal_text->id]) : '' ?></td>
                        <td><?= $eventType->has('legal_text') ? $eventType->legal_text->text : '' ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Invoice Text') ?></td>
                        <td><?= $eventType->has('invoice_text') ? $this->Html->link($eventType->invoice_text->name, ['controller' => 'Settings', 'action' => 'view', $eventType->invoice_text->id]) : '' ?></td>
                        <td><?= $eventType->has('invoice_text') ? $eventType->invoice_text->text : '' ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Application Reference - What is the Application Referred to as?') ?></td>
                        <td><?= $eventType->has('application_ref') ? $this->Html->link($eventType->application_ref->name, ['controller' => 'Settings', 'action' => 'view', $eventType->invoice_text->id]) : '' ?></td>
                        <td><?= $eventType->has('application_ref') ? $eventType->application_ref->text : '' ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4><?= __('Available Booking Options') ?></h4>
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?= __('Simple Booking') ?></td>
                        <td><?= $eventType->simple_booking ? __('Yes') : __('No'); ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Sync Booking') ?></td>
                        <td><?= $eventType->sync_book ? __('Yes') : __('No'); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h4><?= __('Fields Collected') ?></h4>
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?= __('Date Of Birth') ?></td>
                        <td><?= $eventType->date_of_birth ? __('Yes') : __('No'); ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Medical') ?></td>
                        <td><?= $eventType->medical ? __('Yes') : __('No'); ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Parent Applications') ?></td>
                        <td><?= $eventType->parent_applications ? __('Yes') : __('No'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related Events') ?></h3>
    </div>
    <?php if (!empty($eventType->events)): ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?= __('Name') ?></th>
                <th><?= __('Live') ?></th>
                <th><?= __('New Apps') ?></th>
                <th><?= __('Start Date') ?></th>
                <th><?= __('End Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($eventType->events as $events): ?>
                <tr>
                    <td><?= h($events->name) ?></td>
                    <td><?= $events->live ? __('Yes') : __('No'); ?></td>
                    <td><?= $events->new_apps ? __('Yes') : __('No'); ?></td>
                    <td><?= h($events->start_date) ?></td>
                    <td><?= h($events->end_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['prefix' => 'admin', 'controller' => 'Events', 'action' => 'view', $events->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['prefix' => 'admin', 'controller' => 'Events', 'action' => 'edit', $events->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['prefix' => 'admin', 'controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related Events</p>
    <?php endif; ?>
</div>
