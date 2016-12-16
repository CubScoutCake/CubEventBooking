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
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'application_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'logistic_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'param_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'logistic_items_application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
            'lgit_application_idx' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
            'lgit_logistic_idx' => ['type' => 'index', 'columns' => ['logistic_id'], 'length' => []],
            'logistic_items_logistic_id' => ['type' => 'index', 'columns' => ['logistic_id'], 'length' => []],
            'logistic_items_param_id' => ['type' => 'index', 'columns' => ['param_id'], 'length' => []],
            'lgit_param_idx' => ['type' => 'index', 'columns' => ['param_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'logistic_items_application_id' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['applications', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'logistic_items_logistic_id' => ['type' => 'foreign', 'columns' => ['logistic_id'], 'references' => ['logistics', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'logistic_items_param_id' => ['type' => 'foreign', 'columns' => ['param_id'], 'references' => ['params', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'param_id' => 1,
            'deleted' => 1481496337
        ],
    ];
}
