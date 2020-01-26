<?php
/**
 * CakePHP DatabaseLog Plugin
 *
 * Licensed under The MIT License.
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @link https://github.com/dereuromark/CakePHP-DatabaseLog
 */
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Log fixtures
 */
class LogsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null],
        'type' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 50],
        'message' => ['type' => 'text', 'null' => false, 'default' => null],
        'context' => ['type' => 'text', 'null' => true, 'default' => null],
        'created' => ['type' => 'datetime', 'null' => true, 'default' => null],
        'ip' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'hostname' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 50],
        'uri' => ['type' => 'string', 'null' => true, 'default' => null],
        'refer' => ['type' => 'string', 'null' => true, 'default' => null],
        'user_agent' => ['type' => 'string', 'null' => true, 'default' => null],
        'count' => ['type' => 'integer', 'null' => false, 'default' => 0],
        '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]],
        '_options' => [],
    ];

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'context' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2018-11-18 22:47:27',
                'ip' => 'Lorem ipsum dolor sit amet',
                'hostname' => 'Lorem ipsum dolor sit amet',
                'uri' => 'Lorem ipsum dolor sit amet',
                'refer' => 'Lorem ipsum dolor sit amet',
                'user_agent' => 'Lorem ipsum dolor sit amet',
                'count' => 1,
            ],
        ];
        parent::init();
    }
}
