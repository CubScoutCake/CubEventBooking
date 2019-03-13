<?php
/**
 * @var \App\View\AppView $this
 *
 * @var \App\Model\Entity\Section $section
 * @var array $sectionTypes
 * @var array $scoutgroups
 */
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($section) ?>
        <fieldset>
            <legend><?= __('Section Selection / Creation') ?></legend>
            <?php
            echo $this->Form->control('section_type_id', ['empty' => true, 'options' => $sectionTypes, 'class' => 'hierarchy-select']);
            echo $this->Form->control('scoutgroup_id', ['empty' => true, 'options' => $scoutgroups, 'class' => 'hierarchy-select']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
