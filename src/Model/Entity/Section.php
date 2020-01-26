<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Section Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 * @property string $section
 * @property int $section_type_id
 * @property int $scoutgroup_id
 * @property bool $validated
 * @property int $cc_users
 * @property int $cc_atts
 * @property int $cc_apps
 *
 * @property \App\Model\Entity\SectionType $section_type
 * @property \App\Model\Entity\Scoutgroup $scoutgroup
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Attendee[] $attendees
 * @property \App\Model\Entity\User[] $users
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Section extends Entity
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
        'id' => false,
    ];
}
