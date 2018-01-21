<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php $content = explode("\n", $content); ?>
<h2>Hertfordshire Cubs Booking System - Password Reset</h2>

<p>You are receiving this email because someone requested a password reset on your account.</p>

<p><strong>User Name:</strong> <?= h($username) ?></p>
<p><strong>Full Name:</strong> <?= h($full_name) ?></p>
<h3>Actions</h3>
<ul>
	<li><?= $this->Html->link('Reset Password', ['_full' => true, 'controller' => 'Users', 'action' => 'token', 'prefix' => false, $uid, $token]) ?></li>
</ul>

<p>This link will work until 23:59 on the day it was triggered.</p>

<p>Your user was created at <?= $this->Time->i18nFormat($date_created, 'HH:mm') ?> on <?= $this->Time->i18nFormat($date_created, 'dd-MMM-yy') ?>. If this was not you, please email <?= $this->Html->link('info@hertscubs.uk', 'mailto:info@hertscubs.uk') ?>.</p>
<p>We will occasionally contact you from time to time with account notifications (e.g. <span>'your payment has been recieved'</span>) and with upcoming events. These won't be frequent and you will have the option to unsubscribe.</p>
