<?php

use Migrations\AbstractMigration;

class InvoiceMinimumDeposit extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this
            ->table('invoices')
            ->renameColumn('initialvalue', 'initial_value')
            ->renameColumn('value', 'paid_value')
            ->addColumn('minimum_deposit', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();
    }
}
