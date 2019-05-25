<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 */
?>
<div class="row form form-row">
    <div class="col-md-12">
        <?= $this->Form->create($reservation) ?>
        <fieldset>
            <div class="row form-row">
                <div class="col-lg-6"><?= $this->Form->control('user.firstname', ['label' => 'Parent or Guardian First Name']) ?></div>
                <div class="col-lg-6"><?= $this->Form->control('user.lastname', ['label' => 'Parent or Guardian Last Name']) ?></div>
            </div>
            <?php
            echo $this->Form->control('user.email', ['label' => 'Parent or Guardian Email']);
            echo $this->Form->control('user.phone', ['label' => 'Parent or Guardian Emergency Contact Number']);

            echo $this->Form->control('user.address_1');
            echo $this->Form->control('user.address_2');
            echo $this->Form->control('user.city');
            echo $this->Form->control('user.county', ['default' => 'Hertfordshire']);
            echo $this->Form->control('user.postcode');

            ?>
            <div class="form-row">
                <div class="col"><?= $this->Form->control('attendee.firstname', ['label' => 'Young Person First Name']) ?></div>
                <div class="col"><?= $this->Form->control('attendee.lastname', ['label' => 'Young Person Last Name']) ?></div>
            </div>
            <?= $this->Form->control('attendee.section_id', ['options' => $sections, 'empty' => true, 'class' => 'hierarchy-select form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0', 'label' => 'Scout Group - Section']); ?>

            <?php /**
             * @var int $idx
             * @var \App\Model\Entity\Logistic $logistic
             */
            foreach ($event->logistics as $idx => $logistic) : ?>

                <?= $this->Form->control('logistics_item.' . $idx . '.logistic_id', ['value' => $logistic->id, 'type' => 'hidden']); ?>
                <?= $this->Form->control('logistics_item.' . $idx . '.param_id', ['options' => $sessions, 'type' => 'select', 'label' => $logistic->text]); ?>

                <?php foreach ($logistic->parameter->params as $param) : ?>
                    <?= $param->constant ?><?php echo ' '; ?><?php if (key_exists('remaining', $logistic->variable_max_values[$param->id])) : ?><?= $this->Number->format($logistic->variable_max_values[$param->id]['remaining']) ?> Remaining. <?php endif; ?>
                <?php endforeach; ?>

            <?php endforeach; ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
