<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Allergy Entity.
 */
class Allergy extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'description' => true,
        'attendees' => true,
    ];
}
