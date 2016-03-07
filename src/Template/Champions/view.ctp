<?= $this->start('Sidebar');
echo $this->element('Sidebar/start');
echo $this->element('Sidebar/locked');
echo $this->element('Sidebar/user');
echo $this->element('Sidebar/end');
$this->end(); ?>

<?= $this->fetch('Sidebar') ?>

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
            <td><a href="mailto:<?= h($champion->email) ?>" target="_top"><?= h($champion->email) ?></a></td>
        </tr>
        <tr>
            <th><?= __('District') ?></th>
            <td><?= $champion->has('district') ? $this->Html->link($champion->district->district, ['controller' => 'Districts', 'action' => 'view', $champion->district->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($champion->id) ?></td>
        </tr>
    </table>
</div>
