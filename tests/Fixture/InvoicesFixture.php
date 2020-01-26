<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoicesFixture
 */
class InvoicesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'user_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'application_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'paid_value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'paid' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'initial_value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'reservation_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'minimum_deposit' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        '_indexes' => [
            'invoices_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'invoices_application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'invoices_application_id_fkey' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['applications', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'invoices_reservation_id_fkey' => ['type' => 'foreign', 'columns' => ['reservation_id'], 'references' => ['reservations', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'invoices_user_id_fkey' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
                'user_id' => 1,
                'application_id' => 1,
                'paid_value' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'paid' => 1,
                'initial_value' => 1,
                'deleted' => null,
                'reservation_id' => null,
                'minimum_deposit' => null,
            ],
            [
                'user_id' => 1,
                'application_id' => 3,
                'paid_value' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'paid' => 1,
                'initial_value' => 1,
                'deleted' => null,
                'reservation_id' => null,
                'minimum_deposit' => null,
            ],
            [
                'user_id' => 1,
                'application_id' => 2,
                'paid_value' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'paid' => 1,
                'initial_value' => 1,
                'deleted' => date_create('2016-12-26 23:22:30'),
                'reservation_id' => 1,
                'minimum_deposit' => null,
            ],
            [
                'user_id' => 1,
                'application_id' => null,
                'paid_value' => 0,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'paid' => 1,
                'initial_value' => 1,
                'deleted' => null,
                'reservation_id' => 1,
                'minimum_deposit' => null,
            ],
        ];
        parent::init();
    }
}
