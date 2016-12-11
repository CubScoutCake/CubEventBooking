<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Logistic Entity.
 *
 * @property int $id
 * @property int $parameter_id
 * @property \App\Model\Entity\Parameter $parameter
 * @property int $event_id
 * @property string $header
 * @property string $text
 * @property \App\Model\Entity\Application $application
 * @property \App\Model\Entity\Logisticstype $logisticstype
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
