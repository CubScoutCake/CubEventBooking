<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $legacy_section
 * @property string|null $permit_holder
 * @property \Cake\I18n\Time|null $created
 * @property \Cake\I18n\Time|null $modified
 * @property int $modification
 * @property int|null $event_id
 * @property int|null $osm_event_id
 * @property int|null $cc_att_total
 * @property int|null $cc_att_cubs
 * @property int|null $cc_att_yls
 * @property int|null $cc_att_leaders
 * @property int|null $cc_inv_count
 * @property int|null $cc_inv_total
 * @property int|null $cc_inv_cubs
 * @property int|null $cc_inv_yls
 * @property int|null $cc_inv_leaders
 * @property \Cake\I18n\Time|null $deleted
 * @property int|null $section_id
 * @property int $application_status_id
 * @property array|null $hold_numbers
 *
 * @property string|null $team_leader
 * @property string $leader
 *
 * @property string $display_code
 *
 * @property string $permitholder
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\ApplicationStatus $application_status
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Invoice $invoice
 * @property \App\Model\Entity\LogisticItem[] $logistic_items
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Attendee[] $attendees
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
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
        'application_status_id' => true,
        'hold_numbers' => true,
        'user' => true,
        'section' => true,
        'application_status' => true,
        'event' => true,
        'invoice' => true,
        'logistic_items' => true,
        'notes' => true,
        'attendees' => true,
    ];

    /**
     * Specification of a standard method of building a display code.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getDisplayCode()
    {
        return 'E0' . $this->_properties['event_id'] . ' - APP#' . $this->_properties['id'];
    }

    /**
     * Specification of a standard method of building a display code.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getPermitholder()
    {
        if (is_null($this->_properties['team_leader'])) {
            return $this->_properties['permit_holder'];
        }

        return $this->_properties['team_leader'];
    }

    /**
     * Specification of a standard method of building a display code.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getLeader()
    {
        if (is_null($this->_properties['team_leader'])) {
            return $this->_properties['permit_holder'];
        }

        return $this->_properties['team_leader'];
    }

    protected $_virtual = ['display_code', 'permitholder', 'leader'];
}
