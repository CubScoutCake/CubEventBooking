<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $address_1
 * @property string|null $address_2
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property string|null $legacy_section
 * @property \Cake\I18n\Time|null $created
 * @property \Cake\I18n\Time|null $modified
 * @property string $username
 * @property int|null $osm_user_id
 * @property string|null $osm_secret
 * @property int|null $osm_section_id
 * @property int|null $osm_linked
 * @property \Cake\I18n\Time|null $osm_linkdate
 * @property int|null $osm_current_term
 * @property \Cake\I18n\Time|null $osm_term_end
 * @property string|null $pw_reset
 * @property \Cake\I18n\Time|null $last_login
 * @property int|null $logins
 * @property bool|null $validated
 * @property \Cake\I18n\Time|null $deleted
 * @property string|null $digest_hash
 * @property string|null $pw_salt
 * @property string|null $api_key_plain
 * @property string|null $api_key
 * @property int $auth_role_id
 * @property int|null $password_state_id
 * @property int|null $membership_number
 * @property int|null $section_id
 * @property int|null $simple_attendees
 * @property bool $member_validated
 * @property bool $section_validated
 * @property bool $email_validated
 * @property string $full_name
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\AuthRole $auth_role
 * @property \App\Model\Entity\PasswordState $password_state
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Attendee[] $attendees
 * @property \App\Model\Entity\Champion[] $champions
 * @property \App\Model\Entity\EmailSend[] $email_sends
 * @property \App\Model\Entity\Invoice[] $invoices
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Notification[] $notifications
 * @property \App\Model\Entity\Payment[] $payments
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
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
        'role_id' => true,
        'firstname' => true,
        'lastname' => true,
        'email' => true,
        'password' => true,
        'phone' => true,
        'address_1' => true,
        'address_2' => true,
        'city' => true,
        'county' => true,
        'postcode' => true,
        'legacy_section' => true,
        'created' => true,
        'modified' => true,
        'username' => true,
        'osm_user_id' => true,
        'osm_secret' => true,
        'osm_section_id' => true,
        'osm_linked' => true,
        'osm_linkdate' => true,
        'osm_current_term' => true,
        'osm_term_end' => true,
        'pw_reset' => true,
        'last_login' => true,
        'logins' => true,
        'validated' => true,
        'deleted' => true,
        'digest_hash' => true,
        'pw_salt' => true,
        'api_key_plain' => true,
        'api_key' => true,
        'auth_role_id' => true,
        'password_state_id' => true,
        'membership_number' => true,
        'section_id' => true,
        'simple_attendees' => true,
        'member_validated' => true,
        'section_validated' => true,
        'email_validated' => true,
        'role' => true,
        'auth_role' => true,
        'password_state' => true,
        'section' => true,
        'applications' => true,
        'attendees' => true,
        'champions' => true,
        'email_sends' => true,
        'invoices' => true,
        'notes' => true,
        'notifications' => true,
        'payments' => true,
        'tokens' => true
    ];

    /**
     * Hashes the password when a password is set.
     *
     * @param string $value This is the password as entered to be hashed.
     * @return bool|string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($value);
    }

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = ['password', 'digest_hash', 'pw_salt'];

    /**
     * Specifies the method for building up a user's full name.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getFullName()
    {
        return $this->_properties['firstname'] . ' ' . $this->_properties['lastname'];
    }

    /**
     * Exposed Virtual Properties
     *
     * @var array
     */
    protected $_virtual = ['full_name'];
}
