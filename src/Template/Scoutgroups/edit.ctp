<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $scoutgroup->scoutgroup],
                ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroup->scoutgroup)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Scoutgroups'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="scoutgroups form large-10 medium-9 columns">
    <?= $this->Form->create($scoutgroup) ?>
    <fieldset>
        <legend><?= __('Edit Scoutgroup') ?></legend>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('district_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
