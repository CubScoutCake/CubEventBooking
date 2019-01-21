<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemType Entity
 *
 * @property int $id
 * @property string $item_type
 * @property int $role_id
 * @property bool $minor
 * @property bool $cancelled
 * @property bool $available
 * @property bool $team_price
 *
 * @property \App\Model\Entity\InvoiceItem[] $invoice_items
 */
class ItemType extends Entity
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
}
