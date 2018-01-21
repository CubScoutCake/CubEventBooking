<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $legacy_section
 * @property string $permit_holder
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $modification
 * @property int $event_id
 * @property int $osm_event_id
 * @property int $cc_att_total
 * @property int $cc_att_cubs
 * @property int $cc_att_yls
 * @property int $cc_att_leaders
 * @property int $cc_inv_count
 * @property int $cc_inv_total
 * @property int $cc_inv_cubs
 * @property int $cc_inv_yls
 * @property int $cc_inv_leaders
 * @property \Cake\I18n\Time $deleted
 * @property int $section_id
 * @property string $team_leader
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Invoice $invoice
 * @property \App\Model\Entity\LogisticItem[] $logistic_items
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Attendee[] $attendees
 */
class Application extends Entity
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
        'user_id' => true,
        'legacy_section' => true,
        'permit_holder' => true,
        'created' => true,
        'modified' => true,
        'modification' => true,
        'event_id' => true,
        'osm_event_id' => true,
        'cc_att_total' => true,
        'cc_att_cubs' => true,
        'cc_att_yls' => true,
        'cc_att_leaders' => true,
        'cc_inv_count' => true,
        'cc_inv_total' => true,
        'cc_inv_cubs' => true,
        'cc_inv_yls' => true,
        'cc_inv_leaders' => true,
        'deleted' => true,
        'section_id' => true,
        'team_leader' => true,
        'user' => true,
        'section' => true,
        'event' => true,
        'invoice' => true,
        'logistic_items' => true,
        'notes' => true,
        'attendees' => true
    ];

    /**
     * Specification of a standard method of building a display code.
     *
     * @return string
     */
    protected function _getDisplayCode()
    {
        return 'E0' . $this->_properties['event_id'] . ' - APP#' . $this->_properties['id'];
    }

    protected $_virtual = ['display_code'];
}
