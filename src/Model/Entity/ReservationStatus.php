<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReservationStatus Entity
 *
 * @property int $id
 * @property string $reservation_status
 * @property bool $active
 * @property bool $complete
 * @property bool $cancelled
 * @property int $status_order
 * @property string $email_code
 *
 * @property \App\Model\Entity\Reservation[] $reservations
 */
class ReservationStatus extends Entity
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
        'reservation_status' => true,
        'active' => true,
        'complete' => true,
        'cancelled' => true,
        'status_order' => true,
        'reservations' => true,
        'email_code' => true,
    ];
}
