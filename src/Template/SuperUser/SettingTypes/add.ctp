<div class="settingTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($settingType) ?>
    <fieldset>
        <legend><?= __('Add Setting Type') ?></legend>
        <?php
            echo $this->Form->input('setting_type');
            echo $this->Form->input('description');
            echo $this->Form->input('min_auth');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
