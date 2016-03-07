<?= $this->assign('title', 'OSM Integration'); ?>
<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="osm form large-10 medium-9 columns">
    <?= $this->Form->create($sectionForm); ?>
    <fieldset>
        <legend><?= __('Select Your OSM Section') ?></legend>
        <?php
            echo $this->Form->select('osm_section', $hsec, ['label' => 'Online Scout Manager Section']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>