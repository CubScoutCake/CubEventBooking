<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property int $role_id
 * @property \App\Model\Entity\Role $role
 * @property int $scoutgroup_id
 * @property \App\Model\Entity\Scoutgroup $scoutgroup
 * @property string $authrole
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property string $section
 * @property int $osm_user_id
 * @property string $osm_secret
 * @property int $osm_section_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $username
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Attendee[] $attendees
 */
class User extends Entity
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

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($value);
    }

    //protected $_hidden = ['password'];

    protected function _getFullName()
    {
        return $this->_properties['firstname'] . ' ' . $this->_properties['lastname'];
    }

    protected $_virtual = ['full_name'];

    /*public function implementedEvents()
    {
        return [
            'Model.afterSave' => 'onRegistration'
        ];
    }

    public function onRegistration(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if ($entity->isNew()) {
            $this->send('welcome', [$entity]);
        }
    }*/
}
