<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit District'), ['action' => 'edit', $district->district]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete District'), ['action' => 'delete', $district->district], ['confirm' => __('Are you sure you want to delete # {0}?', $district->district)]) ?> </li>
        <li><?= $this->Html->link(__('List Districts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="districts view large-10 medium-9 columns">
    <h2><?= h($district->district) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('District') ?></h6>
            <p><?= h($district->district) ?></p>
            <h6 class="subheader"><?= __('County') ?></h6>
            <p><?= h($district->county) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($district->id) ?></p>
        </div>
    </div>
</div>
