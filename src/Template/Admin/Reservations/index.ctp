<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation[]|\Cake\Collection\CollectionInterface $reservations
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-clipboard-list fa-fw"></i> Reservations</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id', 'Reservation Number') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('event_id') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('attendee_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('reservation_status_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('expires') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= h($reservation->reservation_number) ?></td>
                        <td><?= $reservation->has('event') ? $this->Html->link($reservation->event->name, ['controller' => 'Events', 'action' => 'view', $reservation->event->id]) : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $reservation->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-check"></i>', ['action' => 'process', $reservation->id], ['title' => __('Process'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $reservation->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $reservation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservation->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $reservation->has('user') ? $this->Html->link($reservation->user->full_name, ['controller' => 'Users', 'action' => 'view', $reservation->user->id]) : '' ?></td>
                        <td><?= $reservation->has('attendee') ? $this->Html->link($reservation->attendee->full_name, ['controller' => 'Attendees', 'action' => 'view', $reservation->attendee->id]) : '' ?></td>
                        <td><?= $reservation->has('reservation_status') ? h($reservation->reservation_status->reservation_status) : '' ?></td>
                        <td><?= $this->Time->format($reservation->created, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->format($reservation->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->format($reservation->expires, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
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
            </div>
        </div>
    </div>
</div>
