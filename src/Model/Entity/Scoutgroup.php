<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Scoutgroup Entity
 *
 * @property int $id
 * @property string $scoutgroup
 * @property int $district_id
 * @property int|null $number_stripped
 * @property \Cake\I18n\FrozenTime|null $deleted
 *
 * @property \App\Model\Entity\District $district
 * @property \App\Model\Entity\Section[] $sections
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Scoutgroup extends Entity
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
        'scoutgroup' => true,
        'district_id' => true,
        'number_stripped' => true,
        'deleted' => true,
        'district' => true,
        'sections' => true
    ];
}
