<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Scoutgroup Entity.
 */
class Scoutgroup extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
    	'id' => true,
        'scoutgroup' => true,
        'district_id' => true
    ];
}
