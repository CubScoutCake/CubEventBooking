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
<h2>Balance Outstanding</h2>

<p>Your Invoice (number <?= $this->Number->format($invoice_id) ?>) currently has a balance <strong>outstanding</strong> of <strong><?= $this->Number->currency($balance,'GBP') ?></strong>.</p>

<p><strong>Please arrange payment as soon as possible.</strong></p>

<p>This invoice currently has a balance of <?= $this->Number->currency($balance,'GBP') ?>. The initial value of this invoice was <?= $this->Number->currency($initialvalue,'GBP') ?> and the total sum of payments received on this invoice to date is <?= $this->Number->currency($value,'GBP') ?>.</p>
<p>If outstanding balances are not received, it is likely that your application and invoice will be cancelled. In the event of cancellation due to non-payment all existing sums recieved are non-refundable.</p>
<h3>Actions</h3>
<ul>
	<li><?= $this->Html->link('Login', ['_full' => true, 'controller' => 'Users', 'action' => 'login', 'prefix' => false]) ?></li>
	<li><?= $this->Html->link('View this Notification', ['_full' => true, 'controller' => 'Notifications', 'prefix' => false, 'action' => 'view', $notification_id]) ?></li>
	<li><?= $this->Html->link('View this Invoice', ['_full' => true, 'controller' => $link_controller, 'prefix' => false, 'action' => 'view', $link_id]) ?></li>
</ul>
<h3>User Information</h3>
<p><strong>User Name:</strong> <?= h($username) ?></p>
<p><strong>Full Name:</strong> <?= h($full_name) ?></p>
<p><strong>Scout Group:</strong> <?= h($scoutgroup) ?></p>

<p>Your user was created at <?= $this->Time->i18nFormat($date_created, 'HH:mm') ?> on <?= $this->Time->i18nFormat($date_created, 'dd-MMM-yy') ?>. If this was not you, please email <?= $this->Html->link('info@hertscubs.uk', 'mailto:info@hertscubs.uk') ?>.</p>
<p>We will occasionally contact you from time to time with account notifications (e.g. <span>'your payment has been recieved'</span>) and with upcoming events. These won't be frequent and you will have the option to unsubscribe.</p>




