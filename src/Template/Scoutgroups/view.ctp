<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/locked');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="scoutgroups view large-9 medium-8 columns content">
    <h3><?= h($scoutgroup->scoutgroup) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Scoutgroup') ?></th>
            <td><?= h($scoutgroup->scoutgroup) ?></td>
        </tr>
        <tr>
            <th><?= __('District') ?></th>
            <td><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($scoutgroup->id) ?></td>
        </tr>
        <tr>
            <th><?= __('The Scout Group Number (without the text i.e. 4th --> 4)') ?></th>
            <td><?= $this->Number->format($scoutgroup->number_stripped) ?></td>
        </tr>
    </table>    
</div>
