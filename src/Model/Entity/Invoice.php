<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $application_id
 * @property float|null $value
 * @property \Cake\I18n\Time|null $created
 * @property \Cake\I18n\Time|null $modified
 * @property bool|null $paid
 * @property float|null $initialvalue
 * @property \Cake\I18n\Time|null $deleted
 * @property int|null $reservation_id
 *
 * @property float $balance
 * @property string $display_code
 * @property bool $is_paid
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Application $application
 * @property \App\Model\Entity\Reservation $reservation
 * @property \App\Model\Entity\InvoiceItem[] $invoice_items
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Payment[] $payments
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
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
        'reservation_id' => true,
        'reservation' => true,
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
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getBalance()
    {
        return $this->_properties['initialvalue'] - $this->_properties['value'];
    }

    /**
     * Build the display code property.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getDisplayCode()
    {
        return 'INV #' . $this->_properties['id'];
    }

    /**
     * Build the is paid property.
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    protected function _getIsPaid()
    {
        if ($this->_properties['initialvalue'] <= $this->_properties['value'] && $this->_properties['initialvalue'] != 0) {
            return true;
        }

        return false;
    }

    protected $_virtual = ['balance', 'display_code', 'is_paid'];
}
