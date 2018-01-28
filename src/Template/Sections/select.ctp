<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($section) ?>
        <fieldset>
            <legend><?= __('Section Selection / Creation') ?></legend>
            <?php
            echo $this->Form->input('section_type_id', ['empty' => true, 'options' => $sectionTypes]);
            echo $this->Form->input('scoutgroup_id', ['empty' => true, 'options' => $scoutgroups]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
