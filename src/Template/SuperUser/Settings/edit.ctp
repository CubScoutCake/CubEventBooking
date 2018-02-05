<div class="settings form large-9 medium-8 columns content">
	<?= $this->Form->create($setting) ?>
    <fieldset>
        <legend><?= __('Edit Setting') ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('text');
		echo $this->Form->input('setting_type_id', ['options' => $settingTypes, 'empty' => false]);
		echo $this->Form->input('number');
		?>
    </fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>
