<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AttendeesAllergy Entity
 *
 * @property int $attendee_id
 * @property int $allergy_id
 *
 * @property \App\Model\Entity\Attendee $attendee
 * @property \App\Model\Entity\Allergy $allergy
 */
class AttendeesAllergy extends Entity
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
        'attendee_id' => false,
        'allergy_id' => false
    ];
}
