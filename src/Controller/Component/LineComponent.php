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
 * @property \App\Model\Table\EventsTable $Events
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

        /** @var \App\Model\Entity\Invoice $invoice */
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

        // Find Team, Cub, YL & Leader Counts
        $appNumbers = $this->Availability->getApplicationNumbers($invoice->application->id);

        $this->parseDeposit($invoice->application->event_id, $invoice->id, $appNumbers, $admin);

        foreach ($invoice->application->event->prices as $price) {
            if ($price->item_type->team_price) {
                $this->parseLine($invoiceID, $price->id, $appNumbers['NumTeams'], $admin);
            } else {
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
        $this->Invoices = TableRegistry::getTableLocator()->get('Invoices');
        $this->InvoiceItems = $this->Invoices->InvoiceItems;
        $this->Prices = $this->Invoices->Applications->Events->Prices;

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

    /**
     * @param int $eventId The ID of the Event
     * @param int $invoiceId The ID of the Invoice
     * @param array $appNumbers The Availability Numbers
     * @param bool $admin Override locks
     *
     * @return bool
     */
    public function parseDeposit($eventId, $invoiceId, $appNumbers, $admin)
    {
        $this->Prices = TableRegistry::getTableLocator()->get('Prices');
        $this->Events = $this->Prices->Events;

        $event = $this->Events->get($eventId);

        // Quit if Event does not have registered deposit
        if (!$event->deposit) {
            return false;
        }

        $depositPrices = $this->Prices->find('deposits');

        foreach ($depositPrices as $depositPrice) {
            /** @var \App\Model\Entity\Price $depositPrice */
            if ($depositPrice->item_type->team_price) {
                $quantity = $appNumbers['NumTeams'];
            } else {
                $quantity = $appNumbers['NumSection'];
                if ($event->deposit_inc_leaders) {
                    $quantity += $appNumbers['NumNonSection'];
                    $quantity += $appNumbers['NumLeaders'];
                }
            }
            $this->parseLine($invoiceId, $depositPrice->id, $quantity, $admin);
        }

        return true;
    }
}
