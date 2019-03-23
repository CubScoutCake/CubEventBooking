<?php
use Migrations\AbstractMigration;

class LimitedLogistics extends AbstractMigration
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
            ->table('logistics')
            ->addColumn('variable_max_values', 'json', [
                'null' => true,
            ])
            ->addColumn('max_value', 'integer', [
                'null' => true,
            ])
            ->update();

        $this
            ->table('parameters')
            ->addColumn('limited', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->update();
    }
}
