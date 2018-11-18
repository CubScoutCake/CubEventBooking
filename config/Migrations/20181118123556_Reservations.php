<?php
use Migrations\AbstractMigration;

class Reservations extends AbstractMigration
{
	/**
	 * Change Method.
	 *
	 * More information on this method is available here:
	 * http://docs.phinx.org/en/latest/migrations.html#the-change-method
	 *
	 * Uncomment this method if you would like to use it.
	 */
	public function change()
	{
		$table = $this->table('reservation_statuses');

		$table
			->addColumn('reservation_status', 'string', [
				'default' => null,
				'length' => 255,
				'null' => false,
			])
			->addColumn('active', 'boolean')
			->addColumn('complete', 'boolean')
			->save();

		$table
			->insert(['reservation_status' => 'Pending Payment', 'active' => true, 'complete' => false])
			->insert(['reservation_status' => 'Successful', 'active' => true, 'complete' => true])
			->insert(['reservation_status' => 'On Waiting List', 'active' => true, 'complete' => false])
			->insert(['reservation_status' => 'Cancelled', 'active' => false, 'complete' => true])
			->insert(['reservation_status' => 'Expired', 'active' => false, 'complete' => true])
			->save();


		$table = $this->table('reservations');

		$table
			->addColumn('event_id', 'integer', [
				'default' => null,
				'null' => false,
			])
			->addForeignKey(
				'event_id',
				'events',
				'id',
				[
					'update' => 'RESTRICT',
					'delete' => 'RESTRICT'
				]
			)
			->addColumn('user_id', 'integer', [
				'default' => null,
				'null' => false,
			])
			->addForeignKey(
				'user_id',
				'users',
				'id',
				[
					'update' => 'RESTRICT',
					'delete' => 'RESTRICT'
				]
			)
			->addColumn('attendee_id', 'integer', [
				'default' => null,
				'null' => false,
			])
			->addForeignKey(
				'attendee_id',
				'attendees',
				'id',
				[
					'update' => 'RESTRICT',
					'delete' => 'RESTRICT'
				]
			)
			->addColumn('reservation_status_id', 'integer', [
				'default' => 1,
				'null' => false,
			])
			->addForeignKey(
				'reservation_status_id',
				'reservation_statuses',
				'id',
				[
					'update' => 'RESTRICT',
					'delete' => 'RESTRICT'
				]
			)
			->addColumn('created', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => true,
			])
			->addColumn('modified', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => true,
			])
			->addColumn('deleted', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => true,
			])
			->addColumn('expires', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => true,
			])
			->addColumn('reservation_code', 'string', [
				'default' => null,
				'limit' => 255,
				'null' => true,
			])
	        ->create();


		$table = $this->table('invoices');

		$table
			->addColumn('reservation_id', 'integer', [
				'default' => null,
				'null' => true
			])
			->addForeignKey(
				'reservation_id',
				'reservations',
				'id',
				[
					'update' => 'RESTRICT',
					'delete' => 'RESTRICT'
				]
			)
			->save();


		$table = $this->table('logistic_items');

		$table
			->addColumn('reservation_id', 'integer', [
				'default' => null,
				'null' => true
			])
			->addForeignKey(
				'reservation_id',
				'reservations',
				'id',
				[
					'update' => 'RESTRICT',
					'delete' => 'RESTRICT'
				]
			)
			->save();
	}
}
