<?php
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
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 * @property \Cake\I18n\Time $expires
 * @property string $reservation_code
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Attendee $attendee
 * @property \App\Model\Entity\ReservationStatus $reservation_status
 * @property \App\Model\Entity\Invoice[] $invoices
 * @property \App\Model\Entity\LogisticItem[] $logistic_items
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
        'event' => true,
        'user' => true,
        'attendee' => true,
        'reservation_status' => true,
        'invoices' => true,
        'logistic_items' => true
    ];
}
