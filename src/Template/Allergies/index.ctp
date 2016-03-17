<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-exclamation fa-fw"></i> All Allergies</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('allergy') ?></th>
                        <th><?= $this->Paginator->sort('description') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allergies as $allergy): ?>
                        <tr>
                            <td><?= h($allergy->allergy) ?></td>
                            <td><?= h($allergy->description) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $allergy->id]) ?>
                            </td>
                        </tr>
=======
<div class="actions columns large-2 medium-3">
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/create');
    echo $this->element('Sidebar/user');
    $this->end(); ?>

    <?= $this->fetch('Sidebar') ?>
</div>
<div class="allergies index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('allergy') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($allergies as $allergy): ?>
        <tr>
            <td><?= h($allergy->allergy) ?></td>
            <td><?= h($allergy->description) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $allergy->id]) ?>
            </td>
        </tr>
>>>>>>> master

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

