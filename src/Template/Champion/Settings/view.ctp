<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_view');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="settings view large-10 medium-9 columns">
    <h2><?= h($setting->name) ?></h2>
    <div class="row">
        <div class="large-8 columns strings">
            <h6 class="subheader"><?= __('Text') ?></h6>
            <p><?= h($setting->text) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($setting->id) ?></p>
        </div>

    </div>
</div>
