<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parameter Entity
 *
 * @property int $id
 * @property string|null $parameter
 * @property string|null $constant
 * @property int|null $set_id
 * @property \Cake\I18n\Time|null $deleted
 * @property bool $limited
 *
 * @property \App\Model\Entity\ParameterSet $parameter_set
 * @property \App\Model\Entity\Logistic[] $logistics
 * @property \App\Model\Entity\Param[] $params
 */
class Parameter extends Entity
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
        'parameter' => true,
        'constant' => true,
        'set_id' => true,
        'deleted' => true,
        'limited' => true,
        'parameter_set' => true,
        'logistics' => true,
        'params' => true
    ];
}
