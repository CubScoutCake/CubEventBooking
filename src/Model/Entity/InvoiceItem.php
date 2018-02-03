<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceItem Entity
 *
 * @property int $id
 * @property int $invoice_id
 * @property float $value
 * @property string $description
 * @property int $quantity
 * @property int $item_type_id
 * @property bool $visible
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
        '*' => true,
        'id' => false
    ];

    /**
     * Find the price of the invoice item specified.
     *
     * @return mixed
     */
    protected function _getQuantityPrice()
    {
        return $this->_properties['value'] * $this->_properties['quantity'];
    }

    protected $_virtual = ['quantity_price'];
}
