<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventType $eventType
 *
 * @var array $invoiceTexts
 * @var array $legalTexts
 * @var array $applicationRefs
 * @var array $payable
 */
?>
<div>
	<?= $this->Form->create($eventType) ?>
    <fieldset>
        <legend><?= __('Edit Event Type') ?></legend>
		<?php echo $this->Form->control('event_type'); ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Booking Methods</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
								<?= $this->Form->control('simple_booking') ?>
								<?= $this->Form->control('sync_book') ?>
                                <?= $this->Form->control('hold_booking') ?>
                                <?= $this->Form->control('attendee_booking') ?>
                            </div>
                            <div class="col-lg-6">
								<?= $this->Form->control('parent_applications') ?>
                                <?= $this->Form->control('district_booking') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Required Fields</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
								<?= $this->Form->control('date_of_birth') ?>
								<?= $this->Form->control('medical') ?>
								<?= $this->Form->control('dietary') ?>
                            </div>
                            <div class="col-lg-6">
								<?= $this->Form->control('team_leader') ?>
								<?= $this->Form->control('permit_holder') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Display Options</h4>
            </div>
            <div class="panel-body">
				<?= $this->Form->control('display_availability') ?>
                <br/>
				<?= $this->Form->control('invoice_text_id', ['options' => $invoiceTexts, 'empty' => true]) ?>
				<?= $this->Form->control('legal_text_id', ['options' => $legalTexts, 'empty' => true]) ?>
				<?= $this->Form->control('application_ref_id', ['options' => $applicationRefs]) ?>
				<?= $this->Form->control('payable_setting_id', ['options' => $payable, 'empty' => true]) ?>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>