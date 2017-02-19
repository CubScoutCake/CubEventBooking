<div class="row">
    <div class="col-lg-12">
        <h1>Book onto Event</h1>
    </div>
</div>
<br/>
<?php if ($event->new_apps && $event->complete) : ?>
    <?php if ($event->app_full) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-1">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-exclamation-triangle fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Event Full</div>
                                        <hr/>
                                        <div>This event is currently full. Often Events need to set a team limit for logistical reasons. <br/>There may be cancellations or expansion of availability, but this is unlikely.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!$event->app_full) : ?>
        <?php if ($event->event_type->display_availability && $event->max) : ?>
            <div class="row">
                <?php if ($event->max_apps > 0 && !is_null($event->max_apps)) : ?>
                    <?php if ($event->max_section == 0 || is_null($event->max_section)) : ?>
                        <div class="col-lg-12">
                    <?php endif; ?>
                    <?php if ($event->max_section > 0 && !is_null($event->max_section)) : ?>
                        <div class="col-lg-6">
                    <?php endif; ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo (($event->cc_apps / $event->max_apps) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage(($event->cc_apps / $event->max_apps),1,['multiply' => true]); ?>">
                                        <span class="sr-only"><?= $this->Number->toPercentage(($event->cc_apps / $event->max_apps),1,['multiply' => true]); ?> Complete</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-thermometer-half fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>Event Availability</div>
                                        <div class="huge"><?= $this->Number->format($event->max_apps - $event->cc_apps) ?> <?= h($term) ?> Available</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php if ($event->max_section == 0 || is_null($event->max_section)) : ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($event->max_section > 0 && !is_null($event->max_section)) : ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($event->max_section > 0 && !is_null($event->max_section)) : ?>
                    <?php if ($event->max_apps == 0 || is_null($event->max_apps)) : ?>
                        <div class="col-lg-12">
                    <?php endif; ?>
                    <?php if ($event->max_apps > 0 && !is_null($event->max_apps)) : ?>
                        <div class="col-lg-6">
                    <?php endif; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo (($event->cc_apps / $event->max_section) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage(($event->cc_apps / $event->max_section),1,['multiply' => true]); ?>">
                                    <span class="sr-only"><?= $this->Number->toPercentage(($event->cc_apps / $event->max_section),1,['multiply' => true]); ?> Complete</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thermometer-half fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Event Availability</div>
                                    <div class="huge"><?= $this->Number->format($event->max_section - $event->cc_apps) ?> Attendee Slots Available</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($event->max_apps == 0 || is_null($event->max_apps)) : ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($event->max_apps > 0 && !is_null($event->max_apps)) : ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-exchange fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Sync Book</div>
                                        <div>Book using OSM. This is a multi-step process, but means less data entry.</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Applications',
                                'action' => 'book',
                                'prefix' => false,
                                $event->id
                                ]); ?>">
                                <div class='panel-footer'>
                                    <span class='pull-left'>Book</span>
                                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                                    <div class='clearfix'></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">List Book</div>
                                        <div>Book in a List. This process uses a simple list to enter attendees.</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#myModal">
                                <div class="panel-footer">
                                    <span class="pull-left">Book</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-7 text-right">
                                            <div class="huge">List Book</div>
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <br/>
                                        <div class="col-lg-offset-1 col-lg-10">
                                            <?= $this->Form->create($attForm); ?>
                                                <legend><?= __('Number of Attendees Being Registered') ?></legend>
                                                <p>Please enter the number of attendees of each type you are booking for.</p>
                                                <?php
                                                //if ($cubsVis == 1) {
                                                echo $this->Form->input('section');
                                                //}
                                                //if ($ylsVis == 1) {
                                                echo $this->Form->input('non_section');
                                                //}
                                                //if ($leadersVis == 1) {
                                                echo $this->Form->input('leaders');
                                                //}
                                                ?>
                                            <br/>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            Step 1 of 3
                                        </div>
                                        <div class="col-xs-9 pull-right">
                                            <?php echo $this->Form->submit(__('Submit'), ['class' => 'btn btn-primary']); ?>
                                            <?php echo $this->Form->end(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>


                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if (!$event->new_apps || !$event->complete) : ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-1">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-exclamation-triangle fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Event Not Accepting Applications</div>
                                    <hr/>
                                    <div>This event is not accepting applications currently. This might be because the opening date hasn't been reached or because the event template is not finished.
                                        The event is not full.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
