<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $name
 * @property string $full_name
 * @property bool|null $live
 * @property bool|null $new_apps
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property \Cake\I18n\Time|null $created
 * @property \Cake\I18n\Time|null $modified
 * @property bool|null $deposit
 * @property \Cake\I18n\Time|null $deposit_date
 * @property float|null $deposit_value
 * @property bool|null $deposit_inc_leaders
 * @property string|null $deposit_text
 * @property string $logo
 * @property int|null $invtext_id
 * @property int|null $legaltext_id
 * @property int|null $discount_id
 * @property string|null $intro_text
 * @property string $location
 * @property bool|null $max
 * @property int|null $max_cubs
 * @property int|null $max_yls
 * @property int|null $max_leaders
 * @property bool|null $allow_reductions
 * @property bool|null $invoices_locked
 * @property int $admin_user_id
 * @property int|null $max_apps
 * @property int|null $max_section
 * @property \Cake\I18n\Time|null $deleted
 * @property int $event_type_id
 * @property int $section_type_id
 * @property \Cake\I18n\Time|null $closing_date
 * @property int|null $cc_apps
 * @property bool $complete
 * @property int|null $cc_prices
 * @property bool $team_price
 * @property int $event_status_id
 * @property \Cake\I18n\Time|null $opening_date
 * @property int $cc_res
 * @property int $cc_atts
 *
 * @property string $admin_full_name
 * @property bool $app_full
 *
 * @property \App\Model\Entity\Discount $discount
 * @property \App\Model\Entity\EventStatus $event_status
 * @property \App\Model\Entity\User $admin_user
 * @property \App\Model\Entity\EventType $event_type
 * @property \App\Model\Entity\SectionType $section_type
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Logistic[] $logistics
 * @property \App\Model\Entity\Price[] $prices
 * @property \App\Model\Entity\Setting[] $settings
 */
class Event extends Entity
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
        'name' => true,
        'full_name' => true,
        'live' => true,
        'new_apps' => true,
        'start_date' => true,
        'end_date' => true,
        'created' => true,
        'modified' => true,
        'deposit' => true,
        'deposit_date' => true,
        'deposit_value' => true,
        'deposit_inc_leaders' => true,
        'deposit_text' => true,
        'logo' => true,
        'invtext_id' => true,
        'legaltext_id' => true,
        'discount_id' => true,
        'intro_text' => true,
        'location' => true,
        'max' => true,
        'max_cubs' => true,
        'max_yls' => true,
        'max_leaders' => true,
        'allow_reductions' => true,
        'invoices_locked' => true,
        'admin_user_id' => true,
        'max_apps' => true,
        'max_section' => true,
        'deleted' => true,
        'event_type_id' => true,
        'section_type_id' => true,
        'closing_date' => true,
        'cc_apps' => true,
        'complete' => true,
        'cc_prices' => true,
        'team_price' => true,
        'event_status_id' => true,
        'opening_date' => true,
        'cc_res' => true,
        'cc_atts' => true,
        'discount' => true,
        'event_status' => true,
        'admin_user' => true,
        'event_type' => true,
        'section_type' => true,
        'applications' => true,
        'logistics' => true,
        'prices' => true,
        'settings' => true
    ];

    /**
     * Specifies the method for determining Application Booking Full.
     *
     * @return string
     */
    protected function _getAppFull()
    {
        if (isset($this->_properties['cc_apps']) && isset($this->_properties['max_apps'])) {
            if ($this->_properties['cc_apps'] >= $this->_properties['max_apps'] && $this->_properties['max']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Specifies the Admin Full Name
     *
     * @return string
     */
    protected function _getAdminFullName()
    {
        return $this->_properties['admin_firstname'] . ' ' . $this->_properties['admin_lastname'];
    }

    protected $_virtual = ['app_full', 'admin_full_name'];
}
