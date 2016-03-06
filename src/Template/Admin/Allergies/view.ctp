<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_view');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="allergies view large-10 medium-9 columns">
    <h2><?= h($allergy->allergy) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Allergy') ?></h6>
            <p><?= h($allergy->allergy) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($allergy->description) ?></p>
        </div>
    </div>
</div>
