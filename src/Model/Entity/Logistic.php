<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Logistic Entity
 *
 * @property int $id
 * @property int $parameter_id
 * @property int $event_id
 * @property string $header
 * @property string $text
 * @property \Cake\I18n\Time $deleted
 *
 * @property \App\Model\Entity\Parameter $parameter
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\LogisticItem[] $logistic_items
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
        'parameter_id' => true,
        'event_id' => true,
        'header' => true,
        'text' => true,
        'deleted' => true,
        'parameter' => true,
        'event' => true,
        'logistic_items' => true
    ];
}
