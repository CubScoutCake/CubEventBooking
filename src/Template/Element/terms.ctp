<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2019-04-22
 * Time: 18:25
 *
 * @var \App\Model\Entity\Invoice $invoice
 */
?>
<?php if ($invoice->has('application')) : ?>
    <p>
        Deposits for invoices should be made payable to <strong>
            <?= h($invoice->application->event->event_type->payable->text) ?>
        </strong> and sent to
        <strong><?= h($invoice->application->event->name) ?>,
            <?= h($invoice->application->event->admin_user->address_1) ?>,
            <?= $invoice->application->event->admin_user->has('address_2') && !empty($invoice->application->event->admin_user->address_2) ? h($invoice->application->event->admin_user->address_2) . ', ' : '' ?>
            <?= h($invoice->application->event->admin_user->city) ?>, <?= h($invoice->application->event->admin_user->county) ?>.
            <?= h($invoice->application->event->admin_user->postcode) ?>
        </strong> by <strong>
            <?= $this->Time->i18nformat($invoice->application->event->closing_date,'dd-MMM-yyyy') ?>
        </strong>. Please write <strong>
            <?= h($invoice->application->event->event_type->invoice_text->text) ?>
            <?= $this->Number->format($invoice->id) ?>
        </strong> on the back of the cheque.
    </p>
<?php endif; ?>

<?php if ($invoice->has('reservation')) : ?>
    <p>
        Payments should be made payable to <strong>
            <?= h($invoice->reservation->event->event_type->payable->text) ?>
        </strong> and sent to
        <strong><?= h($invoice->reservation->event->name) ?>,
            <?= h($invoice->reservation->event->admin_user->address_1) ?>,
            <?= $invoice->reservation->event->admin_user->has('address_2') && !empty($invoice->reservation->event->admin_user->address_2) ? h($invoice->reservation->event->admin_user->address_2) . ', ' : '' ?>
            <?= h($invoice->reservation->event->admin_user->city) ?>, <?= h($invoice->reservation->event->admin_user->county) ?>.
            <?= h($invoice->reservation->event->admin_user->postcode) ?>
        </strong> by <strong>
            <?= $this->Time->i18nformat($invoice->reservation->expires,'dd-MMM-yy') ?>
        </strong>.
    </p>
<?php endif; ?>