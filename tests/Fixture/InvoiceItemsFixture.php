<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoiceItemsFixture
 *
 */
class InvoiceItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'invoice_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'Value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'Description' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'Quantity' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'itemtype_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'visible' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'invoice_items_invoice_id' => ['type' => 'index', 'columns' => ['invoice_id'], 'length' => []],
            'item_invoice_idx' => ['type' => 'index', 'columns' => ['invoice_id'], 'length' => []],
            'invoice_items_itemtype_id' => ['type' => 'index', 'columns' => ['itemtype_id'], 'length' => []],
            'item_itemtype_idx' => ['type' => 'index', 'columns' => ['itemtype_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'invoice_items_invoice_id' => ['type' => 'foreign', 'columns' => ['invoice_id'], 'references' => ['invoices', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'invoice_items_itemtype_id' => ['type' => 'foreign', 'columns' => ['itemtype_id'], 'references' => ['itemtypes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'invoice_id' => 1,
            'Value' => 1,
            'Description' => 'Lorem ipsum dolor sit amet',
            'Quantity' => 1,
            'itemtype_id' => 1,
            'visible' => 1
        ],
    ];
}
