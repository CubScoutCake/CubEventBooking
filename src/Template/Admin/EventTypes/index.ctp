<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventType[]|\Cake\Collection\CollectionInterface $eventTypes
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-calendar-alt fa-fw"></i> Event Types</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('event_type'); ?></th>
                    <th class="actions"><?= __('Actions'); ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($eventTypes as $eventType): ?>
                    <tr>
                        <td><?= h($eventType->event_type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $eventType->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $eventType->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $eventType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventType->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $eventType->parent_applications  ? 'Parent' : '' ?></td>
                        <td><?= $eventType->district_booking  ? 'District' : '' ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Information</td>
                        <td>DOB <?= $eventType->date_of_birth  ? '<i class="fal fa-check-circle">' : '<i class="fal fa-times-circle">' ?></td>
                        <td>Medical <?= $eventType->medical  ? '<i class="fal fa-check-circle">' : '<i class="fal fa-times-circle">' ?></td>
                        <td>Dietary <?= $eventType->dietary  ? '<i class="fal fa-check-circle">' : '<i class="fal fa-times-circle">' ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Bookings</td>
                        <td><?= $eventType->attendee_booking  ? 'Attendee' : '' ?></td>
                        <td><?= $eventType->simple_booking  ? 'Simple' : '' ?></td>
                        <td><?= $eventType->hold_booking  ? 'Hold' : '' ?></td>
                        <td><?= $eventType->sync_book  ? 'Sync' : '' ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Settings</td>
                        <td><?= $eventType->has('invoice_text') ? $this->Html->link($this->Text->truncate($eventType->invoice_text->text, 10), ['controller' => 'Settings', 'action' => 'view', $eventType->invoice_text->id]) : '' ?></td>
                        <td><?= $eventType->has('legal_text') ? $this->Html->link($this->Text->truncate($eventType->legal_text->text, 18), ['controller' => 'Settings', 'action' => 'view', $eventType->legal_text->id]) : '' ?></td>
                        <td><?= $eventType->has('application_ref') ? $this->Html->link($this->Text->truncate($eventType->application_ref->text, 10), ['controller' => 'Settings', 'action' => 'view', $eventType->application_ref->id]) : '' ?></td>
                        <td><?= $eventType->has('payable') ? $this->Html->link($this->Text->truncate($eventType->payable->text, 18), ['controller' => 'Settings', 'action' => 'view', $eventType->payable->id]) : '' ?></td>
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
