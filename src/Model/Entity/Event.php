<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $name
 * @property string $full_name
 * @property bool $live
 * @property bool $new_apps
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $deposit
 * @property \Cake\I18n\Time $deposit_date
 * @property float $deposit_value
 * @property bool $deposit_inc_leaders
 * @property string $deposit_text
 * @property bool $cubs
 * @property float $cubs_value
 * @property string $cubs_text
 * @property bool $yls
 * @property float $yls_value
 * @property string $yls_text
 * @property bool $leaders
 * @property float $leaders_value
 * @property string $leaders_text
 * @property string $logo
 * @property string $address
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property  int $invtext_id
 * @property int $legaltext_id
 * @property int $discount_id
 * @property string $intro_text
 * @property string $tagline_text
 * @property string $location
 * @property bool $max
 * @property int $max_cubs
 * @property int $max_yls
 * @property int $max_leaders
 * @property bool $allow_reductions
 * @property float $logo_ratio
 * @property bool $invoices_locked
 * @property string $admin_firstname
 * @property string $admin_lastname
 * @property string $admin_email
 * @property int $admin_user_id
 * @property bool $parent_applications
 * @property int $max_apps
 * @property int $max_section
 * @property \Cake\I18n\Time $deleted
 * @property int $event_type_id
 * @property int $section_type_id
 * @property int $event_status_id
 * @property \Cake\I18n\Time $closing_date
 * @property int $cc_apps
 * @property bool $complete
 * @property int $cc_prices
 * @property bool $team_price
 *
 * @property bool $app_full
 * @property string $admin_full_name
 *
 * @property \App\Model\Entity\Discount $discount
 * @property \App\Model\Entity\EventStatus $event_status
 * @property \App\Model\Entity\User $admin_user
 * @property \App\Model\Entity\EventType $event_type
 * @property \App\Model\Entity\SectionType $section_type
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\User $adminUser
 * @property \App\Model\Entity\Logistic[] $logistics
 * @property \App\Model\Entity\Price[] $prices
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
        'cubs' => true,
        'cubs_value' => true,
        'cubs_text' => true,
        'yls' => true,
        'yls_value' => true,
        'yls_text' => true,
        'leaders' => true,
        'leaders_value' => true,
        'leaders_text' => true,
        'logo' => true,
        'address' => true,
        'city' => true,
        'county' => true,
        'postcode' => true,
        'invtext_id' => true,
        'legaltext_id' => true,
        'discount_id' => true,
        'intro_text' => true,
        'tagline_text' => true,
        'location' => true,
        'max' => true,
        'max_cubs' => true,
        'max_yls' => true,
        'max_leaders' => true,
        'allow_reductions' => true,
        'logo_ratio' => true,
        'invoices_locked' => true,
        'admin_firstname' => true,
        'admin_lastname' => true,
        'admin_email' => true,
        'admin_user_id' => true,
        'parent_applications' => true,
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
        'discount' => true,
        'admin_user' => true,
        'event_type' => true,
        'section_type' => true,
        'applications' => true,
        'settings' => true,
        'logistics' => true,
        'prices' => true
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
