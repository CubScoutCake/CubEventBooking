<?php
/**
 * @var string $username
 * @var string $full_name
 * @var \Cake\I18n\Time $date_created
 * @var string $token
 */
?>
<h2>Hertfordshire Cubs Booking System - Password Reset</h2>

<p>You are receiving this email because someone requested a password reset on your account.</p>

<p><strong>User Name:</strong> <?= h($username) ?></p>
<p><strong>Full Name:</strong> <?= h($full_name) ?></p>
<h3>Actions</h3>
<ul>
	<li><?= $this->Html->link('Reset Password', ['_full' => true, 'controller' => 'Tokens', 'action' => 'validate', 'prefix' => false, $token]) ?></li>
</ul>

<p>This link will work for a week.</p>

<p>Your user was created at <?= $this->Time->i18nFormat($date_created, 'HH:mm') ?> on <?= $this->Time->i18nFormat($date_created, 'dd-MMM-yy') ?>. If this was not you, please email <?= $this->Html->link('info@hertscubs.uk', 'mailto:info@hertscubs.uk') ?>.</p>
<p>We will occasionally contact you from time to time with account notifications (e.g. <span>'your payment has been received'</span>) and with upcoming events. These won't be frequent and you will have the option to unsubscribe.</p>
