<?php
/**
 * @var \App\Model\Entity\Event $event
 * @var int $max_section
 * @var string $term
 * @var string $singleTerm
 * @var bool $readyForSync
 * @var array $osmEvents
 *
 * @var \App\Form\AttNumberForm $attForm
 * @var \App\Form\AttNumberForm $holdForm
 * @var \App\Form\SyncBookForm $syncForm
 *
 * @var \App\View\AppView $this
 */
?>
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
                                    <div class="col-xs-3 col-md-1">
                                        <i class="fal fa-calendar-exclamation fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 col-md-11 text-right">
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
                                    <div class="col-xs-3 col-md-1">
                                        <i class="fal fa-thermometer-half fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 col-md-11 text-right">
                                        <div>Event Availability</div>
                                        <div><h2><?= $this->Number->format($event->max_apps - $event->cc_apps) ?> <?= h($term) ?> Available</h2></div>
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
                                    <i class="fal fa-thermometer-half fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Event Availability</div>
                                    <div><h2><?= $this->Number->format($event->max_section - $event->cc_apps) ?> Attendee Slots Available</h2></div>
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

        <?php if ($max_section !== 0 && !$event->event_type->parent_applications)  : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2><?= $term ?> are limited to <?= $max_section ?> <?= $event->section_type->role->role ?>s per <?= $singleTerm ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php if ($event->event_type->sync_book) : ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fal fa-exchange fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">OSM Event Book</div>
                                        <div>Book using an event listed in your OSM.<br/>This is a multi-step process, but means less data entry.</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#syncModal">
                                <div class="panel-footer">
                                    <span class="pull-left">Book</span>
                                    <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($event->event_type->simple_booking) : ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fal fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">List Book</div>
                                        <div>Book in a List.<br/>This method uses a simple list to enter attendees.</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#listModal">
                                <div class="panel-footer">
                                    <span class="pull-left">Book</span>
                                    <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($event->event_type->attendee_booking) : ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fal fa-poll-people fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Attendee Booking</div>
                                            <div>Book with attendees in the System.<br/>This method uses your attendees in the system to book.</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" data-toggle="modal" data-target="#attModal">
                                    <div class="panel-footer">
                                        <span class="pull-left">Book</span>
                                        <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php /*if ($event->event_type->district_booking) : */?><!--
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fal fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">District Book</div>
                                            <div>Book in a List. This process uses a simple list to enter attendees.</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" data-toggle="modal" data-target="#listModal">
                                    <div class="panel-footer">
                                        <span class="pull-left">Book</span>
                                        <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    --><?php /*endif; */?>
                    <?php if ($event->event_type->hold_booking) : ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fal fa-flag fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Hold Book</div>
                                            <div>Reserve a team.<br/>Enables you to book a team in, without adding names until later.</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" data-toggle="modal" data-target="#holdModal">
                                    <div class="panel-footer">
                                        <span class="pull-left">Book</span>
                                        <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if ($event->event_type->simple_booking) : ?>
                    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="listModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fal fa-list fa-5x"></i>
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
                                                echo $this->Form->hidden('booking_type', ['value' => 'list']);
                                                $sectionLabel = $event->section_type->section_type;
                                                //if ($cubsVis == 1) {
                                                echo $this->Form->control('section', ['label' => $sectionLabel]);
                                                //}
                                                //if ($ylsVis == 1) {
                                                echo $this->Form->control('non_section', [ 'label' => 'Non ' . $sectionLabel . ' (e.g. Young Leaders)']);
                                                //}
                                                //if ($leadersVis == 1) {
                                                echo $this->Form->control('leaders', [ 'label' => 'Leaders & DBS Adults']);
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
                    <?php endif; ?>

                    <?php if ($event->event_type->hold_booking) : ?>
                        <div class="modal fade" id="holdModal" tabindex="-1" role="dialog" aria-labelledby="holdModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fal fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-7 text-right">
                                                <div class="huge">Hold Book</div>
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
                                                <?= $this->Form->create($holdForm); ?>
                                                <legend><?= __('Estimated Number of Attendees') ?></legend>
                                                <p>Please enter the expected number of attendees of each type you are booking for.</p>
                                                <?php
                                                $sectionLabel = $event->section_type->section_type;
                                                echo $this->Form->hidden('booking_type', ['value' => 'hold']);
                                                //if ($cubsVis == 1) {
                                                echo $this->Form->control('section', ['label' => $sectionLabel]);
                                                //}
                                                //if ($ylsVis == 1) {
                                                echo $this->Form->control('non_section', [ 'label' => 'Non ' . $sectionLabel . ' (e.g. Young Leaders)']);
                                                //}
                                                //if ($leadersVis == 1) {
                                                echo $this->Form->control('leaders', [ 'label' => 'Leaders & DBS Adults']);
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
                                                Step 1 of 1
                                            </div>
                                            <div class="col-xs-9 pull-right">
                                                <?php echo $this->Form->submit(__('Submit'), ['class' => 'btn btn-danger']); ?>
                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    <?php endif; ?>

                    <?php if ($event->event_type->attendee_booking) : ?>
                        <div class="modal fade" id="attModal" tabindex="-1" role="dialog" aria-labelledby="attModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fal fa-list fa-5x"></i>
                                            </div>
                                            <div class="col-xs-7 text-right">
                                                <div class="huge">Attendee Booking</div>
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
                                                $sectionLabel = $event->section_type->section_type;
                                                echo $this->Form->hidden('booking_type', ['value' => 'list']);
                                                //if ($cubsVis == 1) {
                                                echo $this->Form->control('section', ['label' => $sectionLabel]);
                                                //}
                                                //if ($ylsVis == 1) {
                                                echo $this->Form->control('non_section', [ 'label' => 'Non ' . $sectionLabel . ' (e.g. Young Leaders)']);
                                                //}
                                                //if ($leadersVis == 1) {
                                                echo $this->Form->control('leaders', [ 'label' => 'Leaders & DBS Adults']);
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
                    <?php endif; ?>

                    <?php if ($event->event_type->sync_book) : ?>
                    <div class="modal fade" id="syncModal" tabindex="-1" role="dialog" aria-labelledby="syncModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
	                        <?php if ($readyForSync) : ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fal fa-exchange fa-5x"></i>
                                            </div>
                                            <div class="col-xs-7 text-right">
                                                <div class="huge">Sync Book</div>
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
                                                <?= $this->Form->create($syncForm); ?>
                                                <legend><?= __('Select Event') ?></legend>
                                                <p>Please choose the OSM Event Associated.</p>
                                                <?php
                                                echo $this->Form->control('osm_event', ['options' => $osmEvents]);
                                                ?>
                                                <br/>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                Step 1 of 2
                                            </div>
                                            <div class="col-xs-9 pull-right">
                                                <?php echo $this->Form->submit(__('Submit'), ['class' => 'btn btn-primary']); ?>
                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!$readyForSync) : ?>
                                <div class="modal-content">
                                    <div class="modal-header">
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
                                    <div class="modal-body">
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
                        <!-- /.modal-dialog -->
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($event->event_type->parent_applications) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fal fa-calendar-exclamation fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">Parent Booking</div>
                                <hr/>
                                <div>This event is being booked on a different area of the site, directly by parents on an individual basis.</div>
                            </div>
                        </div>
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
                                    <i class="fal fa-calendar-exclamation fa-5x"></i>
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
