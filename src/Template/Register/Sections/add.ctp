<div class="sections form large-9 medium-8 columns content">
    <?= $this->Form->create($section) ?>
    <fieldset>
        <legend><?= __('Add Section') ?></legend>
        <?php
        echo $this->Form->input('section_type_id', ['options' => $sectionTypes, 'disabled' => 'disabled']);
        echo $this->Form->input('scoutgroup_id', ['options' => $scoutgroups, 'disabled' => 'disabled']);
        echo $this->Form->input('section');
        echo '<br>';
        echo '<span><strong>Please keep Section names as short as possible.</strong> A suggestion has been generated, feel free to modify it.</span><br>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
