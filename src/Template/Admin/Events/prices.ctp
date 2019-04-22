<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 * @var int $prices
 * @var int $additional
 * @var array $itemTypeOptions
 */
?>

    <div class="row">
        <div class="col-md-12">
            <?= $this->Form->create($event) ?>
            <fieldset>
                <legend><i class="fal fa-receipt fa-fw"></i><?= __(' Edit Event Prices') ?></legend>
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
                        <tr>
                            <td>Deposit</td>
                            <td></td>
                            <td><?= $this->Form->control('deposit', ['label' => 'Event has Deposit']) ?></td>
                            <td><?= $this->Form->control('deposit_inc_leaders', ['label' => 'Deposit includes Leaders']) ?></td>
                            <td><?= $this->Form->control('deposit_date') ?></td>
                        </tr>
                        <?php foreach ($event->prices as $idx => $price) : ?>
                            <tr>
                                <td>
                                    <p>Price <?= $idx + 1 ?></p>
                                    <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['controller' => 'Prices', 'action' => 'delete', $price->id], ['confirm' => __('Are you sure you want to delete {0}?', $price->description), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                                </td>
                                <?= $this->Form->control('prices.' . $idx . '.id') ?>
                                <td><?= $this->Form->control('prices.' . $idx . '.item_type_id', ['label' => 'Role or Item Type', 'options' => $itemTypeOptions, 'empty' => true]) ?></td>
                                <td><?= $this->Form->control('prices.' . $idx . '.max_number') ?></td>
                                <td><?= $this->Form->control('prices.' . $idx . '.value') ?></td>
                                <td><?= $this->Form->control('prices.' . $idx . '.description') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php
                        $total = $prices + $additional;
                        for ($priceNum = $prices; $priceNum < $total; $priceNum ++) : ?>
                            <tr>
                                <td>
                                    <p>Price <?= $priceNum + 1 ?></p>
                                </td>
                                <td><?= $this->Form->control('prices.' . $priceNum . '.item_type_id', ['label' => 'Role or Item Type', 'options' => $itemTypeOptions, 'empty' => true]) ?></td>
                                <td><?= $this->Form->control('prices.' . $priceNum . '.max_number') ?></td>
                                <td><?= $this->Form->control('prices.' . $priceNum . '.value') ?></td>
                                <td><?= $this->Form->control('prices.' . $priceNum . '.description') ?></td>
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
        <?php if (!$event->team_price) : ?>
            <h4><?= __('Team Pricing') ?></h4>
            <p><?= __('Remove all variable prices and set single price to application.') ?></p>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Events',
                'action' => 'team_prices',
                'prefix' => 'admin',
                $event->id ]); ?>">
                <button type="button" class="btn btn-outline btn-lg btn-warning"><i class="fal fa-object-group fa-fw"></i> Convert to Team Pricing.</button>
            </a>
        <?php endif; ?>
        <?php if ($event->team_price) : ?>
            <h4><?= __('Application Pricing') ?></h4>
            <p><?= __('Remove all any team prices and variable prices.') ?></p>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Events',
                'action' => 'application_prices',
                'prefix' => 'admin',
                $event->id ]); ?>">
                <button type="button" class="btn btn-outline btn-warning btn-lg"><i class="fal fa-object-group fa-fw"></i> Convert to Application Pricing.</button>
            </a>
        <?php endif; ?>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h4><?= __('Add Prices') ?></h4>
        <p><?= __('Increase the number of available price boxes.') ?></p>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-lg btn-outline btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fal fa-tags"></i> Add Price Rows
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fal fa-tags"></i> Add Additional Price Rows</h4>
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
