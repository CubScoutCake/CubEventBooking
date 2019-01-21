<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Line component
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 * @property \App\Model\Table\ApplicationsTable $Applications
 * @property \App\Model\Table\InvoiceItemsTable $InvoiceItems
 * @property \App\Model\Table\PricesTable $Prices
 */
class LineComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param int $invoiceID The ID of the Invoice
     *
     * @return bool
     */
    public function parseInvoice($invoiceID)
    {
        $this->Invoices = TableRegistry::getTableLocator()->get('Invoices');
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');

        $invoice = $this->Invoices->get($invoiceID, [
            'contain' => 'Applications.Events.Prices.ItemTypes'
        ]);

//      debug($invoice);

        foreach ($invoice->application->event->prices as $price) {
//          debug($price);

            if ($price->item_type->team_price) {
                $this->parseLine($invoiceID, $price->id, 1);
            } else {
                if (!is_null($price->item_type->role_id)) {
                    $application = $this->Applications
                        ->get($invoice->application_id, [
                            'contain' => 'Attendees.Roles'
                        ]);

                    $countAtts = 0;

                    foreach ($application->attendees as $attendee) {
                        if ($attendee->role_id == $price->item_type->role_id) {
                            $countAtts += 1;
                        }
                    }
                    $this->parseLine($invoiceID, $price->id, $countAtts);
                }

                if (is_null($price->item_type->role_id) && !$price->item_type->minor) {
                    $application = $this->Applications
                        ->get($invoice->application_id, [
                            'contain' => 'Attendees.Roles'
                        ]);

                    $countAtts = 0;

                    foreach ($application->attendees as $attendee) {
                        if (!$attendee->role->minor) {
                            $countAtts += 1;
                        }
                    }
                    $this->parseLine($invoiceID, $price->id, $countAtts);
                }
            }
        }

        return true;
    }

    /**
     * @param int $invoiceID The InvoiceID
     * @param int $priceID The Price ID
     * @param int $quantity The Quantity on the Line Item
     *
     * @return bool
     */
    public function parseLine($invoiceID, $priceID, $quantity)
    {
        $this->InvoiceItems = TableRegistry::getTableLocator()->get('InvoiceItems');
        $this->Invoices = TableRegistry::getTableLocator()->get('Invoices');
        $this->Prices = TableRegistry::getTableLocator()->get('Prices');

        $price = $this->Prices->get($priceID, ['contain' => 'ItemTypes']);

        if (is_null($price->item_type_id)) {
            return false;
        }

        $invoice = $this->Invoices->get($invoiceID, ['contain' => 'Applications']);

        if ($price->event_id <> $invoice->application->event_id) {
            return false;
        }

        if ($quantity > $price->max_number) {
            return false;
        }

        $visible = false;
        if ($quantity > 0 && $price->item_type->available) {
            $visible = true;
        }

        $invoiceItem = $this->InvoiceItems->findOrCreate([
            'invoice_id' => $invoiceID,
            'item_type_id' => $price->item_type_id,
        ], null, ['atomic' => false]);

        if (!($invoiceItem instanceof Entity)) {
            return false;
        }

        $data = [
            'value' => $price->value,
            'description' => $price->description,
            'quantity' => $quantity,
            'visible' => $visible,
        ];

        $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $data, ['fields' => [
            'value', 'description', 'quantity', 'visible'
        ]]);

        if ($this->InvoiceItems->save($invoiceItem)) {
            return true;
        }

        return false;
    }
}
