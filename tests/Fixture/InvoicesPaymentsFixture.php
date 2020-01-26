<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoicesPaymentsFixture
 */
class InvoicesPaymentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'invoice_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'payment_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'x_value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        '_indexes' => [
            'invoices_payments_invoice_id' => ['type' => 'index', 'columns' => ['invoice_id'], 'length' => []],
            'invoices_payments_payment_id' => ['type' => 'index', 'columns' => ['payment_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['invoice_id', 'payment_id'], 'length' => []],
            'invoices_payments_invoice_id' => ['type' => 'foreign', 'columns' => ['invoice_id'], 'references' => ['invoices', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'invoices_payments_payment_id' => ['type' => 'foreign', 'columns' => ['payment_id'], 'references' => ['payments', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'payment_id' => 1,
                'x_value' => 1,
            ],
        ];
        parent::init();
    }
}
