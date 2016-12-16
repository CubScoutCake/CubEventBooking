<div class="invoices form large-10 medium-9 columns">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Generate Invoice') ?></legend>
        <?php
            echo $this->Form->input('application_id', ['options' => $applications]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
