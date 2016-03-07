<div class="actions columns large-2 medium-3">
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/locked');
    echo $this->element('Sidebar/user');
    $this->end(); ?>

    <?= $this->fetch('Sidebar') ?>
</div>
<div class="allergies form large-10 medium-9 columns">
    <?= $this->Form->create($allergy) ?>
    <fieldset>
        <legend><?= __('Add Allergy') ?></legend>
        <?php
            echo $this->Form->input('allergy');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
