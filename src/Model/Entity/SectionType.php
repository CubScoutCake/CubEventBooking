<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SectionType Entity
 *
 * @property int $id
 * @property string $section_type
 * @property int $upper_age
 * @property int $lower_age
 * @property int $role_id
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Section[] $sections
 */
class SectionType extends Entity
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
