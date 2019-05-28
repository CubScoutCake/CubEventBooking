<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 */
?>
<?php if (!empty($reservation)): ?>
    <!-- Event Section -->
    <section id="event" class="signup-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline btn-success dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><?= $this->Html->link(__('View Reservation'), ['controller' => 'Reservations', 'action' => 'view', 'prefix' => 'admin', $reservation->id]) ?></li>
                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Reservations', 'action' => 'edit', 'prefix' => 'admin', $reservation->id]) ?></li>
                                <li><?= $this->Html->link(__('Extend'), ['controller' => 'Reservations', 'action' => 'extend', 'prefix' => 'admin', $reservation->id]) ?></li>
                                <li class='divider'></li>
                                <li><?= $this->Form->postLink(__('Cancel'), ['controller' => 'Reservations', 'action' => 'cancel', $reservation->id, 'prefix' => 'admin'], ['confirm' => __('Are you sure you want to cancel # {0}?', $reservation->id)]) ?></li>
                                <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Reservations', 'action' => 'delete', $reservation->id, 'prefix' => 'admin'], ['confirm' => __('Are you sure you want to delete # {0}?', $reservation->id)]) ?></li>
                                <li class='divider'></li>
                                <li><?= $this->Html->link(__('Send Email'), ['controller' => 'Reservations', 'prefix' => 'admin', 'action' => 'confirm', $reservation->id]) ?></li>
                                <li><?= $this->Html->link(__('Add Note'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'new_reservation', $reservation->id]) ?></li>
                            </ul>
                        </div>
                    </div>
                    <br/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 mx-auto">
                    <h2 class="text-white mb-4"><?= $reservation->event->full_name ?></h2>
                    <h3 class="text-white-100">Reservation for <?= $reservation->attendee->full_name ?></h3>
                </div>
            </div>
        </div>
    </section>
    <section id="booking" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default py-4 h-100">
                        <div class="panel-body text-center">
                            <i class="fal fa-3x fa-ticket-alt mb-2"></i>
                            <br/>
                            <h3 class="text-uppercase">Reservation Number</h3>
                            <hr class="my-4">
                            <div><h1 class="display-4 text-black"><?= $reservation->reservation_number ?></h1></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-default py-4 h-100">
                        <div class="panel-body text-center">
                            <i class="fal fa-3x fa-stopwatch mb-2"></i>
                            <br/>
                            <h3 class="text-uppercase">Reservation Expires</h3>
                            <hr class="my-4">
                            <div><h1 class="display-4 text-black"><?= $this->Time->format($reservation->expires, 'dd-MMM-YY HH:mm', 'Europe/London')  ?></h1></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reservation Section -->
    <section id="status" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default py-4 h-100">
                        <div class="panel-body text-center">
                            <i class="fal fa-3x fa-question mb-2"></i>
                            <br/>
                            <h3 class="text-uppercase">Reservation Status</h3>
                            <hr class="my-4">
                            <div><h1 class="display-4 text-black"><?= $reservation->reservation_status->reservation_status ?></h1></div>
                            <p><?= $reservation->reservation_status->complete ? 'Reservation is Complete.' : 'Reservation is not Complete.' ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php foreach ($reservation->logistic_items as $idx => $logistic_item) : ?>
                        <div class="panel panel-default py-4 h-100">
                            <div class="panel-body text-center">
                                <i class="fal fa-3x fa-calendar-check mb-2"></i>
                                <br/>
                                <h3 class="text-uppercase"><?= $logistic_item->logistic->header ?></h3>
                                <hr class="my-4">

                                <div><h1 class="display-4 text-black"><?= h($logistic_item->param->constant)  ?></h1></div>

                                <p>The Session that is reserved.</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="payment" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default py-4 h-100">
                        <div class="panel-body text-center">
                            <i class="fal fa-3x fa-money-check-alt mb-2"></i>
                            <br/>
                            <h3 class="text-uppercase">Payment</h3>
                            <hr class="my-4">
                            <?php if (!$reservation->invoice->is_paid): ?>
                                <div><h1 class="display-4 text-black"><?= $this->Number->currency($reservation->invoice->balance, 'GBP') ?> balance to pay</h1></div>
                                <br />
                                <div class="panel panel-primary">
                                    <div class="panel panel-heading">
                                        <h4 class="panel-title"><?= __('Record Payment') ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <?= $this->Form->create($reservation) ?>
                                        <fieldset>
                                        <?php
                                        echo $this->Form->dateTime('invoice.payments.0.paid', ['label' => 'Date of Payment (date on cheque)', 'default' => 'now']);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('invoice.payments.0.name_on_cheque'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('invoice.payments.0.payment_notes'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('invoice.payments.0.cheque_number'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                    echo $this->Form->control('invoice.payments.0.id', ['type' => 'hidden']);
                                                    echo $this->Form->control('invoice.payments.0._joinData.x_value', ['label' => 'Value to Invoice']);
                                                ?>
                                            </div>
                                        </div>
                                        <?php



                                        ?>
                                        </fieldset>
                                    </div>
                                    <div class="panel-footer">
                                        <?= $this->Form->button(__('Submit')) ?>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="attendee" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default py-4 h-100">
                        <div class="panel-body text-center">
                            <i class="fal fa-3x fa-child mb-2"></i>
                            <br/>
                            <h3 class="text-uppercase">Young Person</h3>
                            <hr class="my-4">
                            <p><strong>First Name:</strong> <?= $reservation->attendee->firstname ?></p>
                            <p><strong>Last Name:</strong> <?= $reservation->attendee->lastname ?></p>
                            <p><strong>Section:</strong> <?= $reservation->attendee->section->section ?></p>
                            <p><strong>Scout Group:</strong> <?= $reservation->attendee->section->scoutgroup->scoutgroup ?></p>
                            <p><strong>District:</strong> <?= $reservation->attendee->section->scoutgroup->district->district ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default py-4 h-100">
                        <div class="panel-body text-center">
                            <i class="fal fa-3x fa-user-alt mb-2"></i>
                            <br/>
                            <h3 class="text-uppercase">Parent Information</h3>
                            <hr class="my-4">
                            <p><strong>First Name:</strong> <?= $reservation->user->firstname ?></p>
                            <p><strong>Last Name:</strong> <?= $reservation->user->lastname ?></p>
                            <p><strong>Email:</strong> <?= $this->Text->autoLinkEmails($reservation->user->email) ?></p>
                            <p><strong>Phone:</strong> <?= h($reservation->user->phone) ?></p>
                            <p><strong>Address:</strong> <?= $reservation->user->address_1 ?>, <?= $reservation->user->has('address_2') && !empty($reservation->user->address_2) ? h($reservation->user->address_2) . ', ' : '' ?><?= $reservation->user->city ?>,
                                <?= $reservation->user->county ?>. <?= $reservation->user->postcode ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (empty($reservation)): ?>
    <div class="reservations form large-9 medium-8 columns content">
        <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Select Reservation') ?></legend>
            <?php
            echo $this->Form->control('id');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
<?php endif; ?>
