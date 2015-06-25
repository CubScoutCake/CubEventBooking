<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity.
 */
class Application extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'scoutgroup_id' => true,
        'section' => true,
        'permitholder' => true,
        'modification' => true,
        'eventname' => true,
        'user' => true,
        'attendees' => true,
    ];
}
