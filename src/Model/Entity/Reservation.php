<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reservation Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int $attendee_id
 * @property int $reservation_status_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime|null $expires
 * @property string|null $reservation_code
 * @property bool $cancelled
 *
 * @property string $reservation_number
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Attendee $attendee
 * @property \App\Model\Entity\ReservationStatus $reservation_status
 * @property \App\Model\Entity\Invoice $invoice
 * @property \App\Model\Entity\LogisticItem[] $logistic_items
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Reservation extends Entity
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
        'event_id' => true,
        'user_id' => true,
        'attendee_id' => true,
        'reservation_status_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'expires' => true,
        'reservation_code' => true,
        'cancelled' => true,
        'event' => true,
        'user' => true,
        'attendee' => true,
        'reservation_status' => true,
        'invoice' => true,
        'logistic_items' => true,
    ];

    /**
     * Specification of the method of building a full name property.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getReservationNumber()
    {
        if (!$this->isNew()) {
            return $this->_properties['id']
                   . '-' . $this->_properties['attendee_id']
                   . '-' . $this->_properties['reservation_code'];
        }

        return 'Unsaved Reservation';
    }

    protected $_virtual = ['reservation_number'];
}
