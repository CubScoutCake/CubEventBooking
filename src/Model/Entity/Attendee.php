<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attendee Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property string $firstname
 * @property string $lastname
 * @property \Cake\I18n\Date $dateofbirth
 * @property string $phone
 * @property string $phone2
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property bool $nightsawaypermit
 * @property bool $vegetarian
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $osm_generated
 * @property int $osm_id
 * @property \Cake\I18n\Time $osm_sync_date
 * @property bool $user_attendee
 * @property \Cake\I18n\Time $deleted
 * @property int $section_id
 * @property int $cc_apps
 *
 * @property string $full_name
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Allergy[] $allergies
 *
 * @property \App\Model\Entity\Allergy[] $medical_issues
 * @property \App\Model\Entity\Allergy[] $dietary_restrictions
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
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
        'user_id' => true,
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
        'vegetarian' => true,
        'created' => true,
        'modified' => true,
        'osm_generated' => true,
        'osm_id' => true,
        'osm_sync_date' => true,
        'user_attendee' => true,
        'deleted' => true,
        'section_id' => true,
        'cc_apps' => true,
        'user' => true,
        'section' => true,
        'role' => true,
        'applications' => true,
        'allergies' => true,
        'dietary_restrictions' => true,
        'medical_issues' => true,
    ];

    /**
     * Specification of the method of building a full name property.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getFullName()
    {
        return $this->_properties['firstname'] . ' ' . $this->_properties['lastname'];
    }

    protected $_virtual = ['full_name'];
}
