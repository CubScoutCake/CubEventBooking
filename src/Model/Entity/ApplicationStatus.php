<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicationStatus Entity
 *
 * @property int $id
 * @property string $application_status
 * @property bool $active
 * @property bool $no_money
 * @property bool $reserved
 * @property bool $attendees_added
 *
 * @property \App\Model\Entity\Application[] $applications
 */
class ApplicationStatus extends Entity
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
        'application_status' => true,
        'active' => true,
        'no_money' => true,
        'reserved' => true,
        'attendees_added' => true,
        'applications' => true
    ];
}
