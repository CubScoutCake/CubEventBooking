<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SettingTypesFixture
 */
class SettingTypesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'setting_type' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'min_auth' => ['type' => 'integer', 'length' => 10, 'default' => '100', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
                'setting_type' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'setting_type' => 'Lorem ipsum  sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'setting_type' => 'LegalText',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'setting_type' => 'InvText',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'setting_type' => 'Lorem ipsum dolor amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'setting_type' => 'AppRef',
                'description' => 'Application Reference',
                'min_auth' => 1
            ],
            [
                'setting_type' => 'Payable',
                'description' => 'Payable Reference',
                'min_auth' => 8
            ],
        ];
        parent::init();
    }
}
