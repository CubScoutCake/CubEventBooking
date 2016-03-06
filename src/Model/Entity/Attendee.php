<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attendee Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $scoutgroup_id
 * @property \App\Model\Entity\Scoutgroup $scoutgroup
 * @property int $role_id
 * @property \App\Model\Entity\Role $role
 * @property string $firstname
 * @property string $lastname
 * @property \Cake\I18n\Time $dateofbirth
 * @property string $phone
 * @property string $phone2
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property bool $nightsawaypermit
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Allergy[] $allergies
 */
class Attendee extends Entity
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
        'id' => false,
    ];

    protected function _getFullName()
    {
        return $this->_properties['firstname'] . ' ' . $this->_properties['lastname'];
    }

    protected $_virtual = ['full_name'];
}
