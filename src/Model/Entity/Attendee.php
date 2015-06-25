<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attendee Entity.
 */
class Attendee extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'scoutgroup_id' => true,
        'role_id' => true,
        'firstname' => true,
        'lastname' => true,
        'dateofbirth' => true,
        'phone' => true,
        'phone2' => true,
        'address_1' => true,
        'address_2' => true,
        'city' => true,
        'county' => true,
        'postcode' => true,
        'nightsawaypermit' => true,
        'user' => true,
        'applications' => true,
        'allergies' => true,
    ];
}
