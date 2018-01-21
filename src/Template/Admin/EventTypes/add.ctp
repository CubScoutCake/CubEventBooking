<?= $this->Form->create($eventType); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Event Type']) ?></legend>
    <?php
    echo $this->Form->input('event_type');
    echo $this->Form->input('simple_booking');
    echo $this->Form->input('date_of_birth');
    echo $this->Form->input('medical');
    echo $this->Form->input('dietary');
    echo $this->Form->input('parent_applications');
    echo $this->Form->input('invoice_text_id', ['options' => $invoiceTexts]);
    echo $this->Form->input('legal_text_id', ['options' => $legalTexts]);
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
