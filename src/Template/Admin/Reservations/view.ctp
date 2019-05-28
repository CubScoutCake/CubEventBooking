<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 * @var \App\Model\Entity\Event $event
 * @var \App\Model\Entity\ReservationStatus $expectedStatus
 *
 * @var bool $complete
 * @var bool $expired
 * @var bool $cancelled
 */

$this->assign('title', 'View Reservation');
?>
<!-- Event Section -->
<section id="event" class="signup-section text-center">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline btn-success dropdown-toggle" data-toggle="dropdown">
                        Actions
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <?php if ($reservation->has('invoice')) : ?>
                            <li><?= $this->Html->link(__('Pay Reservation'), ['controller' => 'Reservations', 'action' => 'process', 'prefix' => 'admin', $reservation->id]) ?></li>
                        <?php endif; ?>
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
</section>


<!-- Reservation Section -->
<section id="booking" class="contact-section">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default py-4 h-100">
                <div class="panel-body text-center">
                    <i class="fal fa-3x fa-ticket-alt mb-2"></i>
                    <br/>
                    <h3 class="text-uppercase">Reservation Number</h3>
                    <hr class="my-4">
                    <div><h1 class="display-4 text-black"><?= $reservation->reservation_number ?></h1></div>
                    <p>Please write this code on the back of your cheque.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default py-4 h-100">
                <div class="panel-body text-center">
                    <i class="fal fa-3x fa-stopwatch mb-2"></i>
                    <br/>
                    <?php if (!$reservation->reservation_status->complete) : ?>
                        <h3 class="text-uppercase">Reservation Expires</h3>
                        <hr class="my-4">
                        <div><h1 class="display-4 text-black"><?= $this->Time->format($reservation->expires->addHour(), 'dd-MMM-YY HH:mm', 'Europe/London')  ?></h1></div>

                        <p>Your reservation will be automatically cancelled if payment is not received before the expiry date.</p>
                    <?php else : ?>
                        <h3 class="text-uppercase">Reservation Created</h3>
                        <hr class="my-4">
                        <div><h1 class="display-4 text-black"><?= $this->Time->format($reservation->created->addHour(), 'dd-MMM-YY HH:mm', 'Europe/London')  ?></h1></div>

                        <p>Date the Reservation was created.</p>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reservation Section -->
<section id="status" class="contact-section">
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
</section>

<?php if ($reservation->has('invoice')) : ?>
    <section id="payment" class="contact-section">
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
                            <p class="text-lg-center">
                                Payments should be made payable to <strong>
                                    <?= h($reservation->event->event_type->payable->text) ?>
                                </strong> and sent to
                                <strong><?= h($reservation->event->name) ?>,
                                    <?= h($reservation->event->admin_user->address_1) ?>,
                                    <?= $reservation->event->admin_user->has('address_2') && !empty($reservation->event->admin_user->address_2) ? h($reservation->event->admin_user->address_2) . ', ' : '' ?>
                                    <?= h($reservation->event->admin_user->city) ?>, <?= h($reservation->event->admin_user->county) ?>.
                                    <?= h($reservation->event->admin_user->postcode) ?>
                                </strong> by <strong>
                                    <?= $this->Time->i18nFormat($reservation->expires,'dd-MMM-yy') ?>
                                </strong>.
                            </p>
                            <p>
                                Unfortunately for this year we are unable to process BACs or online payments due to limitations at the County Office. Please send only cheques.
                            </p>
                            <p>
                                Please write <strong>
                                    <?= h($reservation->reservation_number) ?>
                                </strong> on the back of the cheque.
                            </p>
                        <?php else : ?>
                            <div><h1 class="display-4 text-black"><?= $this->Number->currency($reservation->invoice->value, 'GBP') ?> received.</h1></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section id="attendee" class="contact-section">
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
</section>

<section id="Status">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fal fa-clock fa-fw"></i> Reservation Status
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th><strong>Reservation Status:</strong></th>
                        <th><?= h($reservation->reservation_status->reservation_status) ?></th>
                    </tr>
                    <tr>
                        <td>Complete: <?= $complete ? __('Y') : __('N'); ?></td>
                        <td>Expired: <?= $expired ? __('Y') : __('N'); ?></td>
                    </tr>
                    <tr>
                        <td>Cancelled: <?= $cancelled ? __('Y') : __('N'); ?></td>
                        <td>Expected Status: <?= $expectedStatus->reservation_status ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
