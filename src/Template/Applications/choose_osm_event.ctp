<?php
/**
 * @var bool $readyForSync
 * @var \App\Form\SyncBookForm $syncForm
 * @var array $osmEvents
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h1>Choose OSM Event</h1>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <?php if ($readyForSync) : ?>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-1 col-md-offset-1">
                            <i class="fal fa-exchange fa-3x"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="huge">Sync Book</div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <br/>
                        <div class="col-lg-offset-1 col-lg-10">
                            <?= $this->Form->create($syncForm); ?>
                            <legend><?= __('Select Event') ?></legend>
                            <p>Please choose the OSM Event Associated.</p>
                            <?php
                            echo $this->Form->input('osm_event', ['label' => false, 'options' => $osmEvents]);
                            ?>
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-1">
                            Step 1 of 2
                        </div>
                        <div class="col-md-8 text-right">
                            <?php echo $this->Form->submit(__('Submit'), ['class' => 'btn btn-green']); ?>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!$readyForSync) : ?>
                <div class="panel-content">
                    <div class="panel-header">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fal fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <div class="huge">Sync Book</div>
                            </div>
                            <div class="col-xs-2">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <br/>
                            <div class="col-lg-offset-1 col-lg-3">
                                <?= $this->Html->link('Setup OSM', ['controller' => 'Osm', 'action' => 'home'], ['title' => __('SetupOSM'), 'class' => 'btn btn-default btm-large']) ?>
                            </div>
                            <div class="col-lg-7">
                                <p>You have not yet setup your OSM for use with the booking system. Please do this and then return to this page.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
