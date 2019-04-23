<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuthRole Entity
 *
 * @property int $id
 * @property string $auth_role
 * @property bool $admin_access
 * @property bool $champion_access
 * @property bool $super_user
 * @property bool $parent
 * @property int $auth
 *
 * @property int $auth_value
 *
 * @property \App\Model\Entity\User[] $users
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class AuthRole extends Entity
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
        'id' => false
    ];

    /**
     * Virtual property to get a binary hash of the auth permissions.
     *
     * @return int
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _getAuthValue()
    {
        if ($this->_properties['super_user'] && isset($this->_properties['super_user'])) {
            $super = 1;
        } else {
            $super = 0;
        };

        if ($this->_properties['admin_access'] && isset($this->_properties['admin_access'])) {
            $admin = 1;
        } else {
            $admin = 0;
        };

        if ($this->_properties['champion_access'] && isset($this->_properties['champion_access'])) {
            $champion = 1;
        } else {
            $champion = 0;
        };

        if ($this->_properties['user_access'] && isset($this->_properties['user_access'])) {
            $user = 1;
        } else {
            $user = 0;
        };

        if ($this->_properties['parent_access'] && isset($this->_properties['parent_access'])) {
            $parent = 1;
        } else {
            $parent = 0;
        };

        $binary = $super . $admin . $champion . $user . $parent;

        $authValue = bindec($binary);

        return $authValue;
    }

    protected $_virtual = ['auth_value'];
}
