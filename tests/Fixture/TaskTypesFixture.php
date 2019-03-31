<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TaskTypesFixture
 */
class TaskTypesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'task_type' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'shared_type' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'type_icon' => ['type' => 'string', 'length' => 15, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'type_code' => ['type' => 'string', 'length' => 3, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'task_requirement' => ['type' => 'text', 'length' => null, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
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
                'task_type' => 'Lorem ipsum dolor sit amet',
                'shared_type' => 1,
                'type_icon' => 'Lorem ipsum d',
                'type_code' => 'L',
                'task_requirement' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
            ],
            [
                'task_type' => 'Lorem dolor goat amet',
                'shared_type' => 0,
                'type_icon' => 'fish',
                'type_code' => 'LOL',
                'task_requirement' => 'Lorem morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
            ],
        ];
        parent::init();
    }
}
