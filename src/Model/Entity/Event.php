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
 * @property \Cake\I18n\Time $closing_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $deposit
 * @property bool $complete
 * @property \Cake\I18n\Time $deposit_date
 * @property float $deposit_value
 * @property bool $deposit_inc_leaders
 * @property string $deposit_text
 * @deprecated bool $cubs
 * @deprecated float $cubs_value
 * @deprecated string $cubs_text
 * @deprecated bool $yls
 * @deprecated float $yls_value
 * @deprecated string $yls_text
 * @deprecated bool $leaders
 * @deprecated float $leaders_value
 * @deprecated string $leaders_text
 * @property string $logo
 * @property string $address
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property int $invtext_id
 * @property int $legaltext_id
 * @property int $discount_id
 * @property string $intro_text
 * @property string $tagline_text
 * @property string $location
 * @property bool $max
 * @deprecated  int $max_cubs
 * @deprecated  int $max_yls
 * @deprecated  int $max_leaders
 * @property bool $allow_reductions
 * @property float $logo_ratio
 * @property bool $invoices_locked
 * @property string $admin_firstname
 * @property string $admin_lastname
 * @property string $admin_email
 * @property int $admin_user_id
 * @deprecated bool $parent_applications
 * @property int $max_apps
 * @property int $max_section
 * @property \Cake\I18n\Time $deleted
 * @property int $event_type_id
 * @property int $section_type_id
 * @property int $cc_apps
 * @property int $cc_prices
 *
 * @property \App\Model\Entity\Setting[] $settings
 * @property \App\Model\Entity\Discount $discount
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Logistic[] $logistics
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
        '*' => true,
        'id' => false
    ];

    /**
     * Specifies the method for determining Application Booking Full.
     *
     * @return string
     */
    protected function _getAppFull()
    {
        $value = false;

        if ($this->_properties['cc_apps'] >= $this->_properties['max_apps'] && $this->_properties['max']) {
            $value = true;
        }

        return $value;
    }

    protected $_virtual = ['app_full'];
}
