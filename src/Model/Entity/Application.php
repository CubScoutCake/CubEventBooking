<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $scoutgroup_id
 * @property \App\Model\Entity\Scoutgroup $scoutgroup
 * @property string $section
 * @property string $permitholder
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $modification
 * @property string $eventname
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
        '*' => true,
        'id' => false,
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
