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
 * @property bool $dietary
 * @property bool $parent_applications
 * @property int $invoice_text_id
 * @property int $legal_text_id
 * @property bool $team_leader
 * @property bool $permit_holder
 * @property bool $display_availability
 * @property int $application_ref_id
 * @property bool $sync_book
 * @property int $payable_setting_id
 *
 * @property \App\Model\Entity\Setting $invoice_text
 * @property \App\Model\Entity\Setting $legal_text
 * @property \App\Model\Entity\Setting $application_ref
 * @property \App\Model\Entity\Setting $payable
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
        'event_type' => true,
        'simple_booking' => true,
        'date_of_birth' => true,
        'medical' => true,
        'dietary' => true,
        'parent_applications' => true,
        'invoice_text_id' => true,
        'legal_text_id' => true,
        'team_leader' => true,
        'permit_holder' => true,
        'display_availability' => true,
        'application_ref_id' => true,
        'sync_book' => true,
        'payable_setting_id' => true,
        'invoice_text' => true,
        'legal_text' => true,
        'application_ref' => true,
        'payable' => true,
        'events' => true
    ];
}
