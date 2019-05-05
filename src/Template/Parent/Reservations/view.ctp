<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 * @var \App\Model\Entity\Event $event
 */

$this->assign('title', 'View Reservation');

$this->append('parent-nav', '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#event">Event</a>
                </li>');

$this->append('parent-nav', '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#booking">Reservation</a>
                </li>');

$this->append('parent-nav', '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#payment">Payment</a>
                </li>');

$this->append('parent-nav', '<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#attendee">Young Person</a>
                </li>');
?>
<!-- Event Section -->
<section id="event" class="signup-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white mb-4"><?= $reservation->event->full_name ?></h2>
                <h4 class="text-white-100">Reservation for <?= $reservation->attendee->full_name ?></h4>
            </div>
        </div>
    </div>
</section>


<!-- Reservation Section -->
<section id="booking" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fal fa-3x fa-ticket-alt mb-2"></i>
                        <br/>
                        <h3 class="text-uppercase">Reservation Number</h3>
                        <hr class="my-4">
                        <div><h1 class="display-4 text-black"><?= $reservation->reservation_number ?></h1></div>
                        <p>Please write this code on the back of your cheque.</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
                        <i class="fal fa-3x fa-stopwatch mb-2"></i>
                        <br/>
                        <h3 class="text-uppercase">Reservation Expires</h3>
                        <hr class="my-4">
                        <div><h1 class="display-4 text-black"><?= $this->Time->format($reservation->expires, 'dd-MMM-yy HH:mm')  ?></h1></div>

                        <p>Your reservation will be automatically cancelled if payment is not received before the expiry date.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="payment" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
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
                                    <?= $this->Time->i18nformat($reservation->expires,'dd-MMM-yy') ?>
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
            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
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
            <div class="col">
                <div class="card py-4 h-100">
                    <div class="card-body text-center">
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

<div class="reservations view large-9 medium-8 columns content">
    <?php if (!empty($reservation->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Application Id') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Paid') ?></th>
                <th scope="col"><?= __('Initialvalue') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Reservation Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reservation->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->id) ?></td>
                <td><?= h($invoices->user_id) ?></td>
                <td><?= h($invoices->application_id) ?></td>
                <td><?= h($invoices->value) ?></td>
                <td><?= h($invoices->created) ?></td>
                <td><?= h($invoices->modified) ?></td>
                <td><?= h($invoices->paid) ?></td>
                <td><?= h($invoices->initialvalue) ?></td>
                <td><?= h($invoices->deleted) ?></td>
                <td><?= h($invoices->reservation_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
