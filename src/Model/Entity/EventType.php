<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventType Entity
 *
 * @property int $id
 * @property string $event_type
 * @property bool|null $simple_booking
 * @property bool|null $date_of_birth
 * @property bool|null $medical
 * @property bool|null $dietary
 * @property bool|null $parent_applications
 * @property int|null $invoice_text_id
 * @property int|null $legal_text_id
 * @property bool|null $team_leader
 * @property bool|null $permit_holder
 * @property bool $display_availability
 * @property int $application_ref_id
 * @property bool $sync_book
 * @property int|null $payable_setting_id
 * @property bool $hold_booking
 * @property bool $attendee_booking
 * @property bool $district_booking
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
        'hold_booking' => true,
        'attendee_booking' => true,
        'district_booking' => true,
        'invoice_text' => true,
        'legal_text' => true,
        'application_ref' => true,
        'payable' => true,
        'events' => true,
    ];
}
