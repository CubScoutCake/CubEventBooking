<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoicesPayment Entity
 *
 * @property int $invoice_id
 * @property int $payment_id
 * @property float $xValue
 *
 * @property \App\Model\Entity\Invoice $invoice
 * @property \App\Model\Entity\Payment $payment
 */
class InvoicesPayment extends Entity
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
        'payment_id' => false,
        'invoice_id' => false
    ];
}
