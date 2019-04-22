<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Allergy Entity
 *
 * @property int $id
 * @property string $allergy
 * @property string|null $description
 * @property bool $is_medical
 * @property bool $is_specific
 * @property bool $is_dietary
 *
 * @property \App\Model\Entity\Attendee[] $attendees
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Allergy extends Entity
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
        'allergy' => true,
        'description' => true,
        'is_medical' => true,
        'is_specific' => true,
        'is_dietary' => true,
        'attendees' => true
    ];
}
