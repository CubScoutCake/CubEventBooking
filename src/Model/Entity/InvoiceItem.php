<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceItem Entity.
 *
 * @property int $id
 * @property int $invoice_id
 * @property \App\Model\Entity\Invoice $invoice
 * @property float $Value
 * @property string $Description
 * @property int $Quantity
 * @property int $itemtype_id
 * @property \App\Model\Entity\Itemtype $itemtype
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
        'id' => false,
    ];

    protected function _getQuantityPrice()
    {
        return $this->_properties['Value'] * $this->_properties['Quantity'];
    }

    protected $_virtual = ['quantity_price'];
}
