<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuthRole Entity
 *
 * @property int $id
 * @property int $auth_role
 * @property int $admin_access
 * @property int $champion_access
 * @property int $super_user
 * @property int $auth
 *
 * @property \App\Model\Entity\User[] $users
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
}
