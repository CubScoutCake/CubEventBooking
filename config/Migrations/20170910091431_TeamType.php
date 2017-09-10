<?php
use Migrations\AbstractMigration;

class TeamType extends AbstractMigration
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
    	$table = $this->table('item_types');

    	$table->addColumn('team_price', 'boolean', [
				    'default' => false,
				    'null' => false,
			    ])
	          ->update();

	    $table = $this->table('events');

	    $table->addColumn('team_price', 'boolean', [
				    'default' => false,
				    'null' => false,
			    ])
	          ->update();

    	$table = $this->table('event_types');

	    $table->addColumn('sync_book', 'boolean', [
				    'default' => false,
				    'null' => false,
			    ])
	          ->update();
    }
}
