<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailSend Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $sent
 * @property string $message_id
 * @property int $user_id
 * @property string $subject
 * @property string $routing_domain
 * @property string $from_address
 * @property string $friendly_from
 * @property int $notification_type_id
 * @property int $notification_id
 *
 * @property \App\Model\Entity\Message $message
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\NotificationType $notification_type
 * @property \App\Model\Entity\Notification $notification
 * @property \App\Model\Entity\EmailResponse[] $email_responses
 * @property \App\Model\Entity\Token[] $tokens
 */
class EmailSend extends Entity
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
