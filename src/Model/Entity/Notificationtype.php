<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notificationtype Entity.
 *
 * @property int $id
 * @property string $notification_type
 * @property string $notification_description
<<<<<<< HEAD
 * @property string $icon
=======
>>>>>>> master
 * @property \App\Model\Entity\Notification[] $notifications
 */
class Notificationtype extends Entity
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
