<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Scoutgroup'), ['action' => 'edit', $scoutgroup->scoutgroup]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Scoutgroup'), ['action' => 'delete', $scoutgroup->scoutgroup], ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroup->scoutgroup)]) ?> </li>
        <li><?= $this->Html->link(__('List Scoutgroups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scoutgroup'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="scoutgroups view large-10 medium-9 columns">
    <h2><?= h($scoutgroup->scoutgroup) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Scoutgroup') ?></h6>
            <p><?= h($scoutgroup->scoutgroup) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($scoutgroup->id) ?></p>
            <h6 class="subheader"><?= __('District Id') ?></h6>
            <p><?= $this->Number->format($scoutgroup->district_id) ?></p>
        </div>
    </div>
</div>
