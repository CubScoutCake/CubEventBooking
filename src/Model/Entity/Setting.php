<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $event_id
 * @property int $settingtype_id
 * @property float $number
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Settingtype $settingtype
 */
class Setting extends Entity
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
