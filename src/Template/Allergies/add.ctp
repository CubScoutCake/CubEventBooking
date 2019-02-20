<?php
/**
 * @var \App\View\AppView $this
 *
 * @var \App\Model\Entity\Allergy $allergy
 *
 * @var boolean $lockMedical
 * @var boolean $lockDietary
 */
?>
<div class="allergies form large-10 medium-9 columns">
    <?= $this->Form->create($allergy) ?>
    <fieldset>
        <legend><?= __('Add Allergy') ?></legend>
        <?php
            echo $this->Form->control('allergy');
            echo $this->Form->control('description');
            echo $this->Form->control('is_dietary');
            echo $this->Form->control('is_medical');
            echo $this->Form->control('is_specific');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
