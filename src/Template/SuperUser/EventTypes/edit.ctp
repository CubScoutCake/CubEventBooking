<div class="payments form large-10 medium-10 columns content">
    <?= $this->Form->create($eventType); ?>
        <fieldset>
            <legend><?= __('Edit {0}', ['Event Type']) ?></legend>
            <?php
            echo $this->Form->input('event_type');
            echo $this->Form->input('simple_booking');
            echo $this->Form->input('sync_book');
            echo $this->Form->input('date_of_birth');
            echo $this->Form->input('medical');
            echo $this->Form->input('parent_applications');
            echo $this->Form->input('invoice_text_id', ['options' => $invoiceTexts]);
            echo $this->Form->input('legal_text_id', ['options' => $legalTexts]);
            echo $this->Form->input('application_ref_id', ['options' => $applicationRefs]);
            ?>
        </fieldset>
    <?= $this->Form->button(__("Save")); ?>
    <?= $this->Form->end() ?>
</div>
