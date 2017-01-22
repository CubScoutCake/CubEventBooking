<div class="row">
    <div class="col-lg-offset-0 col-lg-12 col-sm-offset-0 col-sm-12">
    <?= $this->Form->create($section) ?>
    <fieldset>
        <legend><?= __('Add Section') ?></legend>
        <?php
            echo $this->Form->input('section');
            echo $this->Form->input('section_type_id', ['options' => $sectionTypes]);
            echo $this->Form->input('scoutgroup_id', ['options' => $scoutgroups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    </div>
</div>
