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
<h2>Welcome to the Hertfordshire Cubs Booking System</h2>

<p>The system has been designed to simplify the booking process and to bring together all of the county events into one system.</p>
<h3>Basic Information</h3>
<p><strong>User Name:</strong> <?= h($username) ?></p>
<p><strong>Full Name:</strong> <?= h($full_name) ?></p>
<p><strong>Scout Group:</strong> <?= h($scoutgroup) ?></p>
<br />
<h3>Actions</h3>
<ul>
	<li><?= $this->Html->link('Login', ['_full' => true, 'controller' => 'Users', 'action' => 'login', 'prefix' => false]) ?></li>
	<li><?= $this->Html->link('View this Notification', ['_full' => true, 'controller' => 'Notifications', 'prefix' => false, 'action' => 'view', $notification_id]) ?></li>
	<li><?= $this->Html->link('Edit your User Information', ['_full' => true, 'controller' => $link_controller, 'prefix' => false, 'action' => 'edit', $link_id]) ?></li>
</ul>
<br />
<p><strong>Thank-you for Registering.</strong></p>
<p>Your user was created at <?= $this->Time->i18nFormat($date_created, 'HH:mm') ?> on <?= $this->Time->i18nFormat($date_created, 'dd-MMM-yy') ?>. If this was not you, please email <?= $this->Html->link('info@hertscubs.uk', 'mailto:info@hertscubs.uk') ?>.</p>
<p>We will occasionally contact you from time to time with account notifications (e.g. <span>'your payment has been recieved'</span>) and with upcoming events. These won't be frequent and you will have the option to unsubscribe.</p>




