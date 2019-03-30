<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 * @var int $logisticsCount
 * @var int $additional
 * @var array $itemTypeOptions
 */
?>

    <div class="row">
        <div class="col-md-12">
            <?= $this->Form->create($event) ?>
            <fieldset>
                <legend><i class="fal fa-inventory fa-fw"></i><?= __(' Edit Event Logistics') ?></legend>
                <p><strong>WARNING</strong> - Changes in monetary value will not propagate to invoices created before the edit.</p>
                <?= $this->Form->control('name', ['disabled' => 'disabled']) ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->Form->control('start_date', ['disabled' => 'disabled']) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->Form->control('end_date', ['disabled' => 'disabled']) ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <?php foreach ($event->logistics as $idx => $logistic) : ?>
                            <tr>
                                <td>
                                    <p>Logistic <?= $idx + 1 ?></p>
                                    <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['controller' => 'Logistics', 'action' => 'delete', $logistic->id], ['confirm' => __('Are you sure you want to delete {0}?', $logistic->header), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                                </td>
                                <?= $this->Form->control('logistics.' . $idx . '.id') ?>
                                <td><?= $this->Form->control('logistics.' . $idx . '.parameter_id', ['label' => 'Parameter', 'options' => $parameters, 'empty' => true]) ?></td>
                                <td><?= $this->Form->control('logistics.' . $idx . '.header') ?></td>
                                <td><?= $this->Form->control('logistics.' . $idx . '.text') ?></td>
                            </tr>
                            <?php foreach ($logistic->parameter->params as $pmx => $param) : ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <p>Param <?= $pmx + 1 ?></p>
                                        <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['controller' => 'Params', 'action' => 'delete', $param->id], ['confirm' => __('Are you sure you want to delete {0}?', $param->constant), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                                    </td>
                                    <?= $this->Form->control('logistics.' . $idx . '.id') ?>
                                    <td><?= $this->Form->control('logistics.' . $idx . '.variable_max_values.' . $param->id . '.limit', ['type' => 'number', 'label' => 'Limit']) ?></td>
                                    <td><?= $this->Form->control('logistics.' . $idx . '.parameter.params.' . $pmx. '.constant', ['disabled' => true]) ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <?php
                        $total = $logisticsCount + $additional;
                        for ($logisticNum = $logisticsCount; $logisticNum <= $additional; $logisticNum ++) : ?>
                            <tr>
                                <td>
                                    <p>Logistic <?= $logisticNum + 1 ?></p>
                                </td>
                                <td><?= $this->Form->control('logistics.' . $logisticNum . '.item_type_id', ['label' => 'Role or Item Type', 'options' => $parameters, 'empty' => true]) ?></td>
                                <td><?= $this->Form->control('logistics.' . $logisticNum . '.max_number') ?></td>
                                <td><?= $this->Form->control('logistics.' . $logisticNum . '.value') ?></td>
                                <td><?= $this->Form->control('logistics.' . $logisticNum . '.description') ?></td>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
<hr>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h4><?= __('Add Prices') ?></h4>
        <p><?= __('Increase the number of available price boxes.') ?></p>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-lg btn-outline btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fal fa-inventory"></i> Add Logistics Rows
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fal fa-tags"></i> Add Additional Logistics Rows</h4>
            </div>
            <?= $this->Form->create($event) ?>
            <div class="modal-body">
                <p>Number of Additional Price Rows</p>
                <?= $this->Form->number('boxes') ?>
                <?= $this->Form->control('id') ?>
                <?= $this->Form->hidden('additional', ['value' => true]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= $this->Form->button(__('Add '), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
