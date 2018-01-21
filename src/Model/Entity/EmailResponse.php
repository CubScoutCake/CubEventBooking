<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmailResponse Entity
 *
 * @property int $id
 * @property int $email_send_id
 * @property int $email_response_type_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $received
 * @property string $link_clicked
 * @property string $ip_address
 * @property string $bounce_reason
 * @property int $message_size
 *
 * @property \App\Model\Entity\EmailSend $email_send
 * @property \App\Model\Entity\EmailResponseType $email_response_type
 */
class EmailResponse extends Entity
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
