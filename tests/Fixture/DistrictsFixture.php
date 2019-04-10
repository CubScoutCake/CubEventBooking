<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DistrictsFixture
 */
class DistrictsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'district' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'county' => ['type' => 'string', 'length' => 255, 'default' => 'Hertfordshire', 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'short_name' => ['type' => 'string', 'length' => 16, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'districts_district' => ['type' => 'unique', 'columns' => ['district'], 'length' => []],
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
                'district' => 'Letchworth & Baldock',
                'county' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'short_name' => 'Lorem',
            ],
            [
                'district' => 'Kingdom of Oz',
                'county' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'short_name' => 'Lorem',
            ],
            [
                'district' => 'The Farm Place',
                'county' => 'Lorem dolor sit amet',
                'deleted' => null,
                'short_name' => 'Lorem',
            ],
        ];
        parent::init();
    }
}
