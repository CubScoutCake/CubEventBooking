<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventTypesFixture
 *
 */
class EventTypesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'event_type' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'simple_booking' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'date_of_birth' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'medical' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'parent_applications' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'invoice_text_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'legal_text_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'event_types_invoice_text_id' => ['type' => 'index', 'columns' => ['invoice_text_id'], 'length' => []],
            'event_types_legal_text_id' => ['type' => 'index', 'columns' => ['legal_text_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'event_type' => 'Lorem ipsum dolor sit amet',
            'simple_booking' => 1,
            'date_of_birth' => 1,
            'medical' => 1,
            'parent_applications' => 1,
            'invoice_text_id' => 1,
            'legal_text_id' => 1
        ],
    ];
}
