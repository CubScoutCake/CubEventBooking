<?php
/**
 * @var \App\Model\Entity\EmailSend $emailSend
 * @var \App\Model\Entity\Reservation $reservation
 * @var string $token
 */
?>
<h2><?= $emailSend->subject ?></h2>

<p>You are receiving this email because a reservation was added in your name.</p>

<h1>Reservation Number: <strong><?= $reservation->reservation_number ?></strong></h1>

<hr />
<p>Use link below to view the current state of your reservation.</p>

<?= $this->Html->link('View Reservation', ['_full' => true, 'controller' => 'Tokens', 'action' => 'validate', 'prefix' => false, $token]) ?>

<hr />

<p>Your user was created at <?= $this->Time->i18nFormat($emailSend->user->created, 'HH:mm', 'Europe/London') ?> on <?= $this->Time->i18nFormat($emailSend->user->created, 'dd-MMM-yy', 'Europe/London') ?>. If this was not you, please email <?= $this->Html->link('info@hertscubs.uk', 'mailto:info@hertscubs.uk') ?>.</p>
<p>We will occasionally contact you from time to time with account notifications (e.g. <span>'your payment has been received'</span>) and with upcoming events. These won't be frequent and you will have the option to unsubscribe.</p>
