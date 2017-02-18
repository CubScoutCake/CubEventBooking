<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $notification_type_id
 * @property \App\Model\Entity\NotificationType $notification_type
 * @property bool $new
 * @property string $header
 * @property string $text
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $read_date
 * @property string $from
 * @property int $link_id
 * @property string $link_controller
 * @property string $link_prefix
 */
class Notification extends Entity
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

    protected function _getLinkPrefix($link_prefix)
    {
        if ($link_prefix == '') {
            return false;
        }
        return $link_prefix;
    }
}
