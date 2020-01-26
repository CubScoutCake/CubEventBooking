<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceItem Entity
 *
 * @property int $id
 * @property int $invoice_id
 * @property float|null $value
 * @property string|null $description
 * @property int|null $quantity
 * @property int|null $item_type_id
 * @property bool|null $visible
 * @property bool $schedule_line
 *
 * @property float $quantity_price
 *
 * @property \App\Model\Entity\Invoice $invoice
 * @property \App\Model\Entity\ItemType $item_type
 */
class InvoiceItem extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'invoice_id' => true,
        'value' => true,
        'description' => true,
        'quantity' => true,
        'item_type_id' => true,
        'visible' => true,
        'schedule_line' => true,
        'invoice' => true,
        'item_type' => true,
    ];

    /**
     * Find the price of the invoice item specified.
     *
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getQuantityPrice()
    {
        if (isset($this->_properties['quantity'])) {
            return $this->_properties['value'] * $this->_properties['quantity'];
        }
    }

    protected $_virtual = ['quantity_price'];
}
