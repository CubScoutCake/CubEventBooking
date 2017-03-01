<?php
use Migrations\AbstractMigration;

class EventPriceCount extends AbstractMigration
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
        $table = $this->table('events');

        //$table->renameColumn('max_leaders','x_max_leaders')
        //    ->renameColumn('max_cubs', 'x_max_cubs')
        //    ->renameColumn('max_yls', 'x_max_yls')
        //    ->update();

        $table->addColumn('cc_prices', 'integer', [
                'default' => null,
                'null' => true,
            ])
            ->update();
    }
}
