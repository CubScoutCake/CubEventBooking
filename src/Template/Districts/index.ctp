<?php
/**
 * @var \App\Model\Entity\District[] $districts
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-sitemap fa-fw"></i> All Districts</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="sorting"><?= $this->Paginator->sort('district') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('county') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($districts as $district): ?>
                    <tr>
                        <td><?= h($district->district) ?></td>
                        <td><?= h($district->county) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $district->id]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>
