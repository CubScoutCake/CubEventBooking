<?php
use Migrations\AbstractMigration;

class InvoiceAndLogisticsNullable extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$table = $this->table('invoices');

		$table
			->changeColumn('application_id', 'integer', [
				'default' => null,
				'null' => true,
			])
			->save();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$table = $this->table('invoices');

		$table
			->changeColumn('application_id', 'integer', [
				'default' => null,
				'null' => false,
			])
			->save();
	}
}
