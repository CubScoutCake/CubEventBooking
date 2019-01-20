<?php
use Migrations\AbstractSeed;

/**
 * Settings seed.
 */
class SettingsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $this->call('SettingTypesSeed');
        $this->call('NotificationTypesSeed');
        $this->call('ItemTypesSeed');
        $this->call('AllergiesSeed');

        $data = [
            [
                'id' => '1',
                'name' => 'Invoice Text',
                'text' => 'Deposits for invoices should be made payable to <strong>Hertfordshire Scouts - Cubs</strong> and sent to Hertfordshire Cubs 100th Birthday Camp, <strong>76 Monklands, Letchworth, SG6 4XG</strong> by 31-Dec-15. Please write <strong>Invoice #<?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.',
                'created' => '2015-11-29 22:43:40',
                'modified' => '2015-11-29 22:43:40',
                'event_id' => null,
                'setting_type_id' => '3',
                'number' => null,
            ],
            [
                'id' => '3',
                'name' => 'Invoice Std',
                'text' => 'Invoice #',
                'created' => '2015-12-03 19:42:51',
                'modified' => '2015-12-03 19:44:15',
                'event_id' => null,
                'setting_type_id' => '4',
                'number' => null,
            ],
            [
                'id' => '4',
                'name' => 'Payable To',
                'text' => 'Hertfordshire Scouts - Cubs',
                'created' => '2015-12-03 19:42:51',
                'modified' => '2015-12-03 19:42:51',
                'event_id' => null,
                'setting_type_id' => '3',
                'number' => null,
            ],
            [
                'id' => '5',
                'name' => 'Invoice Text - Basic',
                'text' => 'Invoice #',
                'created' => '2015-12-09 22:49:00',
                'modified' => '2015-12-09 22:49:00',
                'event_id' => null,
                'setting_type_id' => '4',
                'number' => null,
            ],
            [
                'id' => '6',
                'name' => 'Invoice Text - Short',
                'text' => 'INV#',
                'created' => '2015-12-09 22:49:48',
                'modified' => '2015-12-09 22:49:48',
                'event_id' => null,
                'setting_type_id' => '4',
                'number' => null,
            ],
            [
                'id' => '7',
                'name' => 'Event_View_Admin',
                'text' => '300',
                'created' => '2015-12-19 17:28:50',
                'modified' => '2015-12-19 17:28:50',
                'event_id' => null,
                'setting_type_id' => '5',
                'number' => null,
            ],
            [
                'id' => '8',
                'name' => 'Events_View',
                'text' => '300',
                'created' => '2015-12-19 17:31:35',
                'modified' => '2015-12-19 17:31:35',
                'event_id' => null,
                'setting_type_id' => '5',
                'number' => null,
            ],
            [
                'id' => '9',
                'name' => 'Events_View_Champion',
                'text' => '300',
                'created' => '2015-12-19 17:31:56',
                'modified' => '2015-12-19 17:31:56',
                'event_id' => null,
                'setting_type_id' => '5',
                'number' => null,
            ],
            [
                'id' => '10',
                'name' => 'OSM API ID',
                'text' => 'AN ID',
                'created' => '2015-12-24 17:31:31',
                'modified' => '2015-12-24 17:31:31',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
            [
                'id' => '11',
                'name' => 'OSM API Token',
                'text' => 'A TOKEN',
                'created' => '2015-12-24 17:32:12',
                'modified' => '2015-12-24 17:32:12',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
            [
                'id' => '12',
                'name' => 'OSM API Base',
                'text' => 'www.onlinescoutmanager.co.uk',
                'created' => '2015-12-24 17:36:37',
                'modified' => '2015-12-28 12:20:37',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
            [
                'id' => '13',
                'name' => 'KeenIO Write API',
                'text' => 'KEEN IO TOKEN',
                'created' => '2016-03-07 19:59:46',
                'modified' => '2016-03-07 19:59:46',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
            [
                'id' => '14',
                'name' => 'KeenIO ProjectID',
                'text' => 'KEEN IO PROJECT ID',
                'created' => '2016-03-07 20:04:01',
                'modified' => '2016-03-07 20:04:01',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
            [
                'id' => '15',
                'name' => 'KeenIO Read API',
                'text' => 'KEEN IO READ API',
                'created' => '2016-03-13 13:40:35',
                'modified' => '2016-03-13 13:40:35',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
            [
                'id' => '16',
                'name' => 'RMax',
                'text' => '259098242',
                'created' => '2016-03-15 22:26:55',
                'modified' => '2016-03-15 22:26:55',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
            [
                'id' => '17',
                'name' => 'RMin',
                'text' => '12',
                'created' => '2016-03-15 22:27:14',
                'modified' => '2016-03-15 22:27:14',
                'event_id' => null,
                'setting_type_id' => '2',
                'number' => null,
            ],
        ];

        $table = $this->table('settings');
        $table->insert($data)->save();
    }
}
