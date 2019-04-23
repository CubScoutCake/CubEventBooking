<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoiceItemsFixture
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
        'value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'description' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'quantity' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'item_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'visible' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'schedule_line' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'invoice_items_invoice_id' => ['type' => 'index', 'columns' => ['invoice_id'], 'length' => []],
            'invoice_items_itemtype_id' => ['type' => 'index', 'columns' => ['item_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'invoice_items_invoice_id' => ['type' => 'foreign', 'columns' => ['invoice_id'], 'references' => ['invoices', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'invoice_items_itemtype_id' => ['type' => 'foreign', 'columns' => ['item_type_id'], 'references' => ['item_types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'invoice_id' => 1,
                'value' => 10,
                'description' => 'CUBS',
                'quantity' => 5,
                'item_type_id' => 2,
                'visible' => 1,
                'schedule_line' => 0
            ],
            [
                'invoice_id' => 1,
                'value' => 0,
                'description' => 'YOUNG LEADERS',
                'quantity' => 4,
                'item_type_id' => 5,
                'visible' => 1,
                'schedule_line' => 0
            ],
            [
                'invoice_id' => 1,
                'value' => 5,
                'description' => 'LEADERS',
                'quantity' => 1,
                'item_type_id' => 6,
                'visible' => 1,
                'schedule_line' => 0,
            ],
        ];
        parent::init();
    }
}
