<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LogisticItem Entity
 *
 * @property int $id
 * @property int $application_id
 * @property int $logistic_id
 * @property int $param_id
 * @property \Cake\I18n\Time $deleted
 * @property int $reservation_id
 *
 * @property \App\Model\Entity\Application $application
 * @property \App\Model\Entity\Logistic $logistic
 * @property \App\Model\Entity\Param $param
 */
class LogisticItem extends Entity
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
        'application_id' => true,
        'logistic_id' => true,
        'param_id' => true,
        'deleted' => true,
        'reservation_id' => true,
        'application' => true,
        'logistic' => true,
        'param' => true,
    ];
}
