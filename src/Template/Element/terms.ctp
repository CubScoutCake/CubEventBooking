<?php

use Cake\Core\Configure;

/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2019-04-22
 * Time: 18:25
 *
 * @var \App\Model\Entity\Invoice $invoice
 * @var \App\View\AppView $this
 */

$bacs = Configure::read('bacs');

?>
<p>Payment can be made by BACS or Cheque.</p>
<br/>

<?php if ($invoice->has('application')) : ?>
    <ul>
        <li>
            <p><strong>BACS:</strong> Reference: <strong>CUBS-A<?= $this->Number->format($invoice->application->id) ?>-INV<?= $this->Number->format($invoice->id) ?></strong> Sort: <strong><?= h($bacs['sort']) ?></strong> Account Number: <strong><?= h($bacs['account']) ?></strong> Account Name: <strong><?= h($bacs['name']) ?></strong></p>
        </li>
        <li>
            <p><strong>Cheque:</strong>
                Cheques should be made payable to <strong>
                    <?= h($invoice->application->event->event_type->payable->text) ?>
                </strong> and sent to
                <strong><?= h($invoice->application->event->name) ?>,
                    <?= h($invoice->application->event->admin_user->address_1) ?>,
                    <?= $invoice->application->event->admin_user->has('address_2') && !empty($invoice->application->event->admin_user->address_2) ? h($invoice->application->event->admin_user->address_2) . ', ' : '' ?>
                    <?= h($invoice->application->event->admin_user->city) ?>, <?= h($invoice->application->event->admin_user->county) ?>.
                    <?= h($invoice->application->event->admin_user->postcode) ?>
                </strong> by <strong>
                    <?= $this->Time->format($invoice->application->event->closing_date,'dd-MMM-yyyy') ?>
                </strong>. Please write <strong>
                    <?= h($invoice->application->event->event_type->invoice_text->text) ?>
                    <?= $this->Number->format($invoice->id) ?>
                </strong> on the back of the cheque.
            </p>
        </li>
    </ul>
    <br/>
    <p>Payment must be made by <strong><?= $this->Time->format($invoice->application->event->closing_date,'dd-MMM-yyyy') ?></strong>.</p>
<?php endif; ?>

<?php if ($invoice->has('reservation')) : ?>
    <ul>
        <li>
            <p><strong>BACS:</strong> Reference: <strong>CUBS-<?= h($invoice->reservation->reservation_number) ?></strong> Sort: <strong><?= h($bacs['sort']) ?></strong> Account Number: <strong><?= h($bacs['account']) ?></strong> Account Name: <strong><?= h($bacs['name']) ?></strong></p>
        </li>
        <li>
            <p>
                Cheques should be made payable to <strong>
                    <?= h($invoice->reservation->event->event_type->payable->text) ?>
                </strong> and sent to
                <strong><?= h($invoice->reservation->event->name) ?>,
                    <?= h($invoice->reservation->event->admin_user->address_1) ?>,
                    <?= $invoice->reservation->event->admin_user->has('address_2') && !empty($invoice->reservation->event->admin_user->address_2) ? h($invoice->reservation->event->admin_user->address_2) . ', ' : '' ?>
                    <?= h($invoice->reservation->event->admin_user->city) ?>, <?= h($invoice->reservation->event->admin_user->county) ?>.
                    <?= h($invoice->reservation->event->admin_user->postcode) ?>
                </strong>.
            </p>
        </li>
    </ul>
    <br/>
    <p>Payment must be made by <strong><?= $this->Time->format($invoice->reservation->expires,'dd-MMM-yy') ?></strong>.</p>
<?php endif; ?>
