<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SettingType Entity
 *
 * @property int $id
 * @property string $setting_type
 * @property string|null $description
 * @property int $min_auth
 *
 * @property \App\Model\Entity\Setting[] $settings
 */
class SettingType extends Entity
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
        'setting_type' => true,
        'description' => true,
        'min_auth' => true,
        'settings' => true
    ];
}
