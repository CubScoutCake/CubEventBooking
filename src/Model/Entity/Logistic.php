<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Logistic Entity.
 *
 * @property int $id
 * @property int $application_id
 * @property \App\Model\Entity\Application $application
 * @property int $logisticstype_id
 * @property \App\Model\Entity\Logisticstype $logisticstype
 * @property string $header
 * @property string $text
 * @property int $parameter_id
 * @property \App\Model\Entity\Parameter $parameter
 */
class Logistic extends Entity
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
}
