<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 *
 * @var array $events
 * @var array $users
 * @var array $attendees
 * @var array $reservationStatuses
 */
?>
<div class="row form form-row">
    <div class="col-md-12">
        <?= $this->Form->create($reservation) ?>
        <fieldset>
            <legend><?= __('Extend Reservation') ?></legend>
            <?php
            echo $this->Form->control('expires');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
