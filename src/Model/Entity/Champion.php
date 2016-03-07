<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Allergy Entity.
 */
class Champion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    protected function _getFullName()
    {
        return $this->_properties['firstname'] . ' ' . $this->_properties['lastname'];
    }

    protected $_virtual = ['full_name'];
}
