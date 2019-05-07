<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventStatus Entity
 *
 * @property int $id
 * @property string $event_status
 * @property bool $live
 * @property bool $accepting_applications
 * @property bool $spaces_full
 * @property bool $pending_date
 * @property int $status_order
 *
 * @property \App\Model\Entity\Event[] $events
 */
class EventStatus extends Entity
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
        'event_status' => true,
        'live' => true,
        'accepting_applications' => true,
        'spaces_full' => true,
        'pending_date' => true,
        'status_order' => true,
        'events' => true
    ];
}
