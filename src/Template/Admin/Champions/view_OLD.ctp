<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_view');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="champions view large-9 medium-8 columns content">
    <h3><?= h($champion->firstname) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Firstname') ?></th>
            <td><?= h($champion->firstname) ?></td>
        </tr>
        <tr>
            <th><?= __('Lastname') ?></th>
            <td><?= h($champion->lastname) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($champion->email) ?></td>
        </tr>
        <tr>
            <th><?= __('District') ?></th>
            <td><?= $champion->has('district') ? $this->Html->link($champion->district->district,'') : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($champion->id) ?></td>
        </tr>
    </table>
</div>
