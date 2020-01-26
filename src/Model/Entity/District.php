<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * District Entity
 *
 * @property int $id
 * @property string $district
 * @property string|null $county
 * @property \Cake\I18n\Time|null $deleted
 * @property string|null $short_name
 *
 * @property \App\Model\Entity\Scoutgroup[] $scoutgroups
 * @property \App\Model\Entity\Champion[] $champions
 */
class District extends Entity
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
        'district' => true,
        'county' => true,
        'deleted' => true,
        'short_name' => true,
        'scoutgroups' => true,
        'champions' => true,
    ];
}
