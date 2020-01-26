<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SettingsFixture
 */
class SettingsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'name' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'text' => ['type' => 'string', 'length' => 999, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'event_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'setting_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'number' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        '_indexes' => [
            'settings_settingtype_id' => ['type' => 'index', 'columns' => ['setting_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'settings_settingtype_id' => ['type' => 'foreign', 'columns' => ['setting_type_id'], 'references' => ['setting_types', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'name' => 'Lorem ipsum dolor sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'event_id' => 1,
                'setting_type_id' => 1,
                'number' => 1,
            ],
            [
                'name' => 'Lorem dolor sit amet',
                'text' => 'Lorem dolor sit amet',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'event_id' => null,
                'setting_type_id' => 2,
                'number' => 1,
            ],
            [
                'name' => 'LegalTxt',
                'text' => 'Legal Text',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'event_id' => 1,
                'setting_type_id' => 3,
                'number' => 1,
            ],
            [
                'name' => 'InvTxt',
                'text' => 'Invoice Text',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'event_id' => 1,
                'setting_type_id' => 4,
                'number' => 1,
            ],
            [
                'name' => 'Lorem ipsum sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'event_id' => 1,
                'setting_type_id' => 5,
                'number' => 1,
            ],
            [
                'name' => 'Application Reference',
                'text' => 'Team',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'event_id' => 1,
                'setting_type_id' => 6,
                'number' => 1,
            ],
            [
                'name' => 'Payment Reference',
                'text' => 'Payable to Cubs',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'event_id' => 1,
                'setting_type_id' => 7,
                'number' => 1,
            ],
        ];
        parent::init();
    }
}
