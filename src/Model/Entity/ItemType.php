<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemType Entity
 *
 * @property int $id
 * @property string $item_type
 * @property int|null $role_id
 * @property bool|null $minor
 * @property bool|null $cancelled
 * @property bool|null $available
 * @property bool $team_price
 * @property bool $deposit
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\InvoiceItem[] $invoice_items
 * @property \App\Model\Entity\Price[] $prices
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
        'item_type' => true,
        'role_id' => true,
        'minor' => true,
        'cancelled' => true,
        'available' => true,
        'team_price' => true,
        'deposit' => true,
        'role' => true,
        'invoice_items' => true,
        'prices' => true,
    ];
}
