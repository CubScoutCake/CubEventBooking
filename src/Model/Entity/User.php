<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity.
 *
 * @property int $id
 * @property int $role_id
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
 * @property string $legacy_section
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $username
 * @property int $osm_user_id
 * @property string $osm_secret
 * @property int $osm_section_id
 * @property int $osm_linked
 * @property \Cake\I18n\Time $osm_linkdate
 * @property int $osm_current_term
 * @property \Cake\I18n\Time $osm_term_end
 * @property string $pw_reset
 * @property \Cake\I18n\Time $last_login
 * @property int $logins
 * @property bool $validated
 * @property \Cake\I18n\Time $deleted
 * @property string $digest_hash
 * @property string $pw_salt
 * @property string $api_key_plain
 * @property string $api_key
 * @property int $auth_role_id
 * @property int $pw_state
 * @property int $membership_number
 * @property int $section_id
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Notification[] $notifications
 * @property \App\Model\Entity\Attendee[] $attendees
 * @property \App\Model\Entity\Invoice[] $invoices
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

    /**
     * Hashes the password when a password is set.
     *
     * @param string $value This is the password as entered to be hashed.
     * @return bool|string
     */
    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($value);
    }

    protected $_hidden = ['password'];

    /**
     * Specifies the method for building up a user's full name.
     *
     * @return string
     */
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
