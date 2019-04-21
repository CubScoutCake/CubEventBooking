<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SectionTypesFixture
 */
class SectionTypesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'section_type' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'upper_age' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'lower_age' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'role_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'section_types_role_id' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['roles', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
                'section_type' => 'Beavers',
                'upper_age' => 8,
                'lower_age' => 6,
                'role_id' => 2
            ],
            [
                'section_type' => 'Cubs',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 3
            ],
            [
                'section_type' => 'Scouts',
                'upper_age' => 14,
                'lower_age' => 10,
                'role_id' => 4
            ],
            [
                'section_type' => 'Explorers',
                'upper_age' => 18,
                'lower_age' => 14,
                'role_id' => 5
            ],
            [
                'section_type' => 'Adults',
                'upper_age' => 99,
                'lower_age' => 18,
                'role_id' => 1
            ],
        ];
        parent::init();
    }
}
