<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 */
?>
<?php if (!empty($reservation)): ?>
    <section id="booking" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel py-4 h-100">
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
                    <div class="panel py-4 h-100">
                        <div class="panel-body text-center">
                            <i class="fal fa-3x fa-stopwatch mb-2"></i>
                            <br/>
                            <h3 class="text-uppercase">Reservation Expires</h3>
                            <hr class="my-4">
                            <div><h1 class="display-4 text-black"><?= $this->Time->format($reservation->expires, 'dd-MMM-yy HH:mm')  ?></h1></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="payment" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel py-4 h-100">
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
                                        echo $this->Form->dateTime('invoices.payments.0.paid', ['label' => 'Date of Payment (date on cheque)', 'default' => 'now']);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('invoices.payments.0.name_on_cheque'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('invoices.payments.0.payment_notes'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo $this->Form->control('invoices.payments.0.cheque_number'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                    echo $this->Form->control('invoices.payments.0.id', ['type' => 'hidden', 'default' => $reservation->invoice->id, 'label' => 'Invoice Associated']);
                                                    echo $this->Form->control('invoices.payments.0._joinData.x_value', ['label' => 'Value to Invoice']);
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
                    <div class="panel py-4 h-100">
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
                    <div class="panel py-4 h-100">
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
