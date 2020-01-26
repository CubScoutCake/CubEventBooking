<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;

/**
 * SectionType Entity
 *
 * @property int $id
 * @property string $section_type
 * @property int $upper_age
 * @property int $lower_age
 * @property int|null $role_id
 *
 * @property string $singular_section_type
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Section[] $sections
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
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
        'section_type' => true,
        'upper_age' => true,
        'lower_age' => true,
        'role_id' => true,
        'role' => true,
        'sections' => true,
    ];

    /**
     * Specifies the method for determining Application Booking Full.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getSingularSectionType()
    {
        return Inflector::singularize($this->_properties['section_type']);
    }

    protected $_virtual = ['singular_section_type'];
}
