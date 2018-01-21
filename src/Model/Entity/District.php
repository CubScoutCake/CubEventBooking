<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * District Entity.
 */
class District extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'id' => false,
        'district' => true,
        'county' => true,
        'short_name' => true,
    ];
}
