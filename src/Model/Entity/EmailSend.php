<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailSend Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $sent
 * @property string|null $message_send_code
 * @property int|null $user_id
 * @property string|null $subject
 * @property string|null $routing_domain
 * @property string|null $from_address
 * @property string|null $friendly_from
 * @property int|null $notification_type_id
 * @property int|null $notification_id
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property string|null $email_generation_code
 * @property string|null $email_template
 * @property bool $include_token
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\NotificationType $notification_type
 * @property \App\Model\Entity\Notification $notification
 * @property \App\Model\Entity\EmailResponse[] $email_responses
 * @property \App\Model\Entity\Token[] $tokens
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
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
        'created' => true,
        'modified' => true,
        'sent' => true,
        'message_send_code' => true,
        'user_id' => true,
        'subject' => true,
        'routing_domain' => true,
        'from_address' => true,
        'friendly_from' => true,
        'notification_type_id' => true,
        'notification_id' => true,
        'deleted' => true,
        'email_generation_code' => true,
        'email_template' => true,
        'include_token' => true,
        'user' => true,
        'notification_type' => true,
        'notification' => true,
        'email_responses' => true,
        'tokens' => true,
    ];
}
