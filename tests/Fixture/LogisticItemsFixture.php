<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LogisticItemsFixture
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
        'reservation_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'logistic_items_application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
            'logistic_items_logistic_id' => ['type' => 'index', 'columns' => ['logistic_id'], 'length' => []],
            'logistic_items_param_id' => ['type' => 'index', 'columns' => ['param_id'], 'length' => []],
            'logistic_items_reservation_id' => ['type' => 'index', 'columns' => ['reservation_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'logistic_items_application_id' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['applications', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'logistic_items_logistic_id' => ['type' => 'foreign', 'columns' => ['logistic_id'], 'references' => ['logistics', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'logistic_items_param_id' => ['type' => 'foreign', 'columns' => ['param_id'], 'references' => ['params', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'logistic_items_reservation_id_fkey' => ['type' => 'foreign', 'columns' => ['reservation_id'], 'references' => ['reservations', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'application_id' => 1,
                'logistic_id' => 1,
                'param_id' => 1,
                'deleted' => null,
                'reservation_id' => 1
            ],
        ];
        parent::init();
    }
}
