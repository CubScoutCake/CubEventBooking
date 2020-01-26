<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NotificationType Entity
 *
 * @property int $id
 * @property string|null $notification_type
 * @property string|null $notification_description
 * @property string|null $icon
 * @property string $type_code
 *
 * @property \App\Model\Entity\EmailSend[] $email_sends
 * @property \App\Model\Entity\Notification[] $notifications
 */
class NotificationType extends Entity
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
        'notification_type' => true,
        'notification_description' => true,
        'icon' => true,
        'type_code' => true,
        'email_sends' => true,
        'notifications' => true,
    ];
}
