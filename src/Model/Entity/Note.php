<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Note Entity.
 *
 * @property int $id
 * @property int $application_id
 * @property \App\Model\Entity\Application $application
 * @property int $invoice_id
 * @property \App\Model\Entity\Invoice $invoice
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property bool $visible
 * @property string $note_text
 */
class Note extends Entity
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
