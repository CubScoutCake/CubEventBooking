<div class="scoutgroups form large-10 medium-9 columns content">
    <?= $this->Form->create($scoutgroup) ?>
    <fieldset>
        <legend><?= __('Add Scoutgroup') ?></legend>
        <?php
            echo $this->Form->input('scoutgroup');
            echo $this->Form->input('district_id', ['options' => $districts]);
            echo $this->Form->input('number_stripped');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
