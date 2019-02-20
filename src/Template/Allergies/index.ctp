<?php
/**
 * @var \App\View\AppView $this
 *
 * @var \App\Model\Entity\Allergy[] $allergies
 *
 * @var boolean $medical
 * @var boolean $dietary
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-allergies fa-fw"></i> Dietary Restrictions & Medical Issues</h3>
        <br/>
        <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="<?= $dietary ? 'active' : '' ?>"><a href="<?= $this->Html->Url->build(['?' => ['dietary' => $dietary ? 'false' : 'true', 'medical' => $medical ? 'true' : 'false' ]]) ?>">Dietary <span class="badge"><?= $dietary ? 'ONLY' : '' ?></span></a></li>
            <li role="presentation" class="<?= $medical ? 'active' : '' ?>"><a href="<?= $this->Html->Url->build(['?' => ['dietary' => $dietary ? 'true' : 'false', 'medical' => $medical ? 'false' : 'true' ]]) ?>">Medical <span class="badge"><?= $medical ? 'ONLY' : '' ?></span></a></li>
        </ul>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('allergy') ?></th>
                        <th><?= $this->Paginator->sort('description') ?></th>
                        <th><?= $this->Paginator->sort('is_medical') ?></th>
                        <th><?= $this->Paginator->sort('is_dietary') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allergies as $allergy): ?>
                        <tr>
                            <td><?= h($allergy->allergy) ?></td>
                            <td><?= h($allergy->description) ?></td>
                            <td><?= $allergy->is_medical ? 'Yes' : 'No' ?></td>
                            <td><?= $allergy->is_dietary ? 'Yes' : 'No' ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $allergy->id]) ?>
                            </td>
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

