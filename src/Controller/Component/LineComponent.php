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
 *
 * @property \App\Controller\Component\AvailabilityComponent $Availability
 * @property \Cake\Controller\Component\FlashComponent $Flash
 */
class LineComponent extends Component
{
    public $components = ['Flash', 'Availability'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param int $invoiceID The ID of the Invoice
     * @param bool $admin Whether it is an admin regenerate (override locks)
     *
     * @return bool
     */
    public function parseInvoice($invoiceID, $admin = false)
    {
        $this->Invoices = TableRegistry::getTableLocator()->get('Invoices');
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');

        $invoice = $this->Invoices->get($invoiceID, [
            'contain' => [
                'Applications' => [
                    'Events' => [
                        'Prices' => [
                            'ItemTypes'
                        ],
                        'SectionTypes',
                    ],
                ]
            ]
        ]);

        foreach ($invoice->application->event->prices as $price) {
            if ($price->item_type->team_price) {
                $this->parseLine($invoiceID, $price->id, 1, $admin);
            } else {
                // Find Cub, YL & Leader Counts
                $appNumbers = $this->Availability->getApplicationNumbers($invoice->application->id);

                if (!is_null($price->item_type->role_id)
                    && $price->item_type->role_id == $invoice->application->event->section_type->role_id
                ) {
                    $this->parseLine($invoiceID, $price->id, $appNumbers['NumSection'], $admin);
                }

                if (!$price->item_type->minor
                    && (is_null($price->item_type->role_id) || $price->item_type->role_id != $invoice->application->event->section_type->role_id)
                ) {
                    $this->parseLine($invoiceID, $price->id, $appNumbers['NumLeaders'], $admin);
                }

                if ($price->item_type->minor
                    && (is_null($price->item_type->role_id) || $price->item_type->role_id != $invoice->application->event->section_type->role_id)
                ) {
                    $this->parseLine($invoiceID, $price->id, $appNumbers['NumNonSection'], $admin);
                }
            }
        }

        return true;
    }

    /**
     * @param int $invoiceID The InvoiceID
     * @param int $priceID The Price ID
     * @param int $quantity The Quantity on the Line Item
     * @param bool $admin Lock to max.
     *
     * @return bool
     */
    public function parseLine($invoiceID, $priceID, $quantity, $admin = false)
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

        if ($quantity > $price->max_number && $admin == false && isset($price->max_number) && $price->max_number > 0) {
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
