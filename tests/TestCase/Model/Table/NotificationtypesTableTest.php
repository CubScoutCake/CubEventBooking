<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\NotificationtypesTable Test Case
 */
class NotificationtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationtypesTable
     */
    public $Notificationtypes;

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
        $config = TableRegistry::exists('Notificationtypes') ? [] : ['className' => 'App\Model\Table\NotificationtypesTable'];
        $this->Notificationtypes = TableRegistry::get('Notificationtypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notificationtypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Notificationtypes->find('all');

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

        $badEntity = $this->Notificationtypes->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Notificationtypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Notificationtypes->save($badEntity));
        $this->Notificationtypes->save($goodEntity);

        $query = $this->Notificationtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
