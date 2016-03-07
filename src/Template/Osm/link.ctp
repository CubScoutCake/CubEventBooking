<?= $this->assign('title', 'OSM Integration'); ?>
<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="osm form large-10 medium-9 columns">
    <?= $this->Form->create($linkForm); ?>
    <fieldset>
        <legend><?= __('Create New Local OSM Link') ?></legend>
        <p>This link will be encrypted with the key on your computer - there is no way for anyone other than you to access your OSM link</p>
        <?php
            echo $this->Form->input('osm_email',['label' => 'Online Scout Manager Email Address (User)']);
            echo $this->Form->label('Online Scout Manager Password');
            echo $this->Form->password('osm_password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
