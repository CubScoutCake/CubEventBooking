<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaskType Entity
 *
 * @property int $id
 * @property string $task_type
 * @property bool $shared_type
 * @property string $type_icon
 * @property string $type_code
 * @property string $task_requirement
 *
 * @property \App\Model\Entity\Task[] $tasks
 */
class TaskType extends Entity
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
        'task_type' => true,
        'shared_type' => true,
        'type_icon' => true,
        'type_code' => true,
        'task_requirement' => true,
        'tasks' => true
    ];
}
