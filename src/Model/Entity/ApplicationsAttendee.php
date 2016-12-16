<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicationsAttendee Entity
 *
 * @property int $application_id
 * @property int $attendee_id
 *
 * @property \App\Model\Entity\Application $application
 * @property \App\Model\Entity\Attendee $attendee
 */
class ApplicationsAttendee extends Entity
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
        'application_id' => false,
        'attendee_id' => false
    ];
}
