<?php
/**
 * @var \App\View\AppView $this
 *
 * @var \App\Model\Entity\Parameter[] $parameters
 *
 * @var array $queryParams
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-cogs fa-fw"></i> Parameters</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('parameter') ?></th>
                        <th><?= $this->Paginator->sort('constant') ?></th>
                        <th><?= $this->Paginator->sort('set_id', 'Parameter Set') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($parameters as $parameter): ?>
                    <tr>
                        <td><?= $this->Number->format($parameter->id) ?></td>
                        <td><?= h($parameter->parameter) ?></td>
                        <td><?= h($parameter->constant) ?></td>
                        <td><?= $parameter->has('parameter_set') ? $this->Html->link($parameter->parameter_set->name, ['controller' => 'ParameterSets', 'action' => 'view', $parameter->parameter_set->id]) : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $parameter->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $parameter->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?>
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
