<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-paw fa-fw"></i> All Scout Groups</h3>
        <div class="table-responsive">
            <table class="table  table-condensed">
                <tr>
                    <td>
                        <?php echo $this->Form->create();
                        echo $this->Form->input('q', ['label' => 'Search for Scout Group']);
                        echo '</td><td>';
                        echo $this->Form->input('district_id', ['options' => $districts, 'empty' => true]);
                        echo '</td><td>';
                        echo $this->Form->button('Filter', ['type' => 'submit']);
                        echo '</td></tr></table></div>';
                        echo $this->Form->end();
                        ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="sorting"><?= $this->Paginator->sort('id', '#') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('scoutgroup', 'Scout Group') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('district_id') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scoutgroups as $scoutgroup): ?>
                    <tr>
                        <td><?= $this->Number->format($scoutgroup->id) ?></td>
                        <td><?= h($scoutgroup->scoutgroup) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $scoutgroup->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    </div>
</div>

