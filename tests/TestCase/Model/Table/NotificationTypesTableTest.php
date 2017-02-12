<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\NotificationTypesTable Test Case
 */
class NotificationTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationTypesTable
     */
    public $NotificationTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notification_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NotificationTypes') ? [] : ['className' => 'App\Model\Table\NotificationTypesTable'];
        $this->NotificationTypes = TableRegistry::get('NotificationTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotificationTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->NotificationTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'notification_type' => 'Lorem ipsum dolor sit amet',
                'notification_description' => 'Lorem ipsum dolor sit amet',
                'icon' => 'Lorem ipsum dolor sit amet'
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $badData = [
            'id' => 2,
            'notification_type' => null,
            'notification_description' => null,
            'icon' => null
        ];

        $goodData = [
            'id' => 2,
            'notification_type' => 'Lorem dolor sit amet',
            'notification_description' => 'Lorem ipsum sit amet',
            'icon' => 'Lorem ipsum dolor sit'
        ];

        $expected = [
            [
                'id' => 1,
                'notification_type' => 'Lorem ipsum dolor sit amet',
                'notification_description' => 'Lorem ipsum dolor sit amet',
                'icon' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'id' => 2,
                'notification_type' => 'Lorem dolor sit amet',
                'notification_description' => 'Lorem ipsum sit amet',
                'icon' => 'Lorem ipsum dolor sit'
            ],
        ];

        $badEntity = $this->NotificationTypes->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->NotificationTypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->NotificationTypes->save($badEntity));
        $this->NotificationTypes->save($goodEntity);

        $query = $this->NotificationTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
