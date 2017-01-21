<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventType Entity
 *
 * @property int $id
 * @property string $event_type
 * @property bool $simple_booking
 * @property bool $date_of_birth
 * @property bool $medical
 * @property bool $parent_applications
 * @property int $invoice_text_id
 * @property int $legal_text_id
 *
 * @property \App\Model\Entity\InvoiceText $invoice_text
 * @property \App\Model\Entity\LegalText $legal_text
 * @property \App\Model\Entity\Event[] $events
 */
class EventType extends Entity
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
