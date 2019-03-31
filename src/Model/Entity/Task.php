<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity
 *
 * @property int $id
 * @property int $task_type_id
 * @property int $user_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time|null $modified
 * @property bool $completed
 * @property \Cake\I18n\Time|null $date_completed
 * @property int|null $completed_by_user_id
 *
 * @property \App\Model\Entity\TaskType $task_type
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\User $completing_user
 */
class Task extends Entity
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
        'task_type_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'completed' => true,
        'date_completed' => true,
        'completed_by_user_id' => true,
        'task_type' => true,
        'user' => true,
        'completing_user' => true,
    ];
}
