<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $application_id
 * @property float $value
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $paid
 * @property float $initialvalue
 * @property \Cake\I18n\Time $deleted
 * @property float $balance
 * @property string $display_code
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Application $application
 *
 * @property \App\Model\Entity\InvoiceItem[] $invoice_items
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Payment[] $payments
 */
class Invoice extends Entity
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
        'user_id' => true,
        'application_id' => true,
        'value' => true,
        'created' => true,
        'modified' => true,
        'paid' => true,
        'initialvalue' => true,
        'deleted' => true,
        'user' => true,
        'application' => true,
        'invoice_items' => true,
        'notes' => true,
        'payments' => true
    ];

    /**
     * Specify the balance of the invoice as determined by balance less payments.
     *
     * @return mixed
     */
    protected function _getBalance()
    {
        return $this->_properties['initialvalue'] - $this->_properties['value'];
    }

    /**
     * Build the display code property.
     *
     * @return string
     */
    protected function _getDisplayCode()
    {
        return 'INV #' . $this->_properties['id'];
    }

    protected $_virtual = ['balance', 'display_code'];
}
