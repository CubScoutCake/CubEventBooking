<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LogisticItemsFixture
 *
 */
class LogisticItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'application_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'logistic_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'param_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
            'logistic_id' => ['type' => 'index', 'columns' => ['logistic_id'], 'length' => []],
            'param_id' => ['type' => 'index', 'columns' => ['param_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'logistic_items_ibfk_1' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['applications', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'logistic_items_ibfk_2' => ['type' => 'foreign', 'columns' => ['logistic_id'], 'references' => ['logistics', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'logistic_items_ibfk_3' => ['type' => 'foreign', 'columns' => ['param_id'], 'references' => ['params', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
            'application_id' => 1,
            'logistic_id' => 1,
            'param_id' => 1
        ],
    ];
}
