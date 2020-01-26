<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property float $value
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $paid
 * @property string $cheque_number
 * @property string $name_on_cheque
 * @property int $user_id
 * @property string $payment_notes
 * @property \Cake\I18n\Time $deleted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Invoice[] $invoices
 */
class Payment extends Entity
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
        'value' => true,
        'created' => true,
        'paid' => true,
        'cheque_number' => true,
        'name_on_cheque' => true,
        'user_id' => true,
        'payment_notes' => true,
        'deleted' => true,
        'user' => true,
        'invoices' => true,
    ];
}
