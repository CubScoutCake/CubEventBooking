<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\SettingsTable Test Case
 */
class SettingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SettingsTable
     */
    public $Settings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.settings',
        'app.settingtypes',
        //'app.events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Settings') ? [] : ['className' => 'App\Model\Table\SettingsTable'];
        $this->Settings = TableRegistry::get('Settings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Settings);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Settings->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->first();

        $this->assertCount(8, $result);
        $this->assertContains(1, $result);
        $this->assertContains('Lorem ipsum dolor sit amet', $result);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $badData = [
            'id' => null,
            'name' => null,
            'text' => null,
            'event_id' => 99,
            'settingtype_id' => 24,
            'number' => 'the fish'
        ];

        $goodData = [
            'id' => 2,
            'name' => 'Lorem Fishy dolor sit amet',
            'text' => 'Lorem ipsum Goaty sit amet',
            'created' => 1482070364,
            'modified' => 1482070364,
            'event_id' => 1,
            'settingtype_id' => 1,
            'number' => 1
        ];

        $expected = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => 1482070364,
                'modified' => 1482070364,
                'event_id' => 1,
                'settingtype_id' => 1,
                'number' => 1
            ],
            [
                'id' => 2,
                'name' => 'Lorem Fishy dolor sit amet',
                'text' => 'Lorem ipsum Goaty sit amet',
                'event_id' => 1,
                'settingtype_id' => 1,
                'number' => 1
            ],
            [
                'id' => 3,
                'district' => 'Lorem ipsum sit amet',
                'county' => 'Lorem dolor sit amet',
                'deleted' => null
            ],
            [
                'id' => 4,
                'district' => 'Lorem fish dolor sit amet',
                'county' => 'Lorem ipsum fish dolor amet',
                'deleted' => null
            ]
        ];

        $badEntity = $this->Settings->newEntity($badData);
        $inaccessibleEntity = $this->Settings->newEntity($goodData);
        $goodEntity = $this->Settings->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Settings->save($badEntity));
        $this->assertFalse($this->Settings->save($inaccessibleEntity));
        $this->Settings->save($goodEntity);

        $this->markTestSkipped();

        $query = $this->Settings->get('2');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertCount(8, $result);
        $this->assertContains(1, $result);
        $this->assertContains('Lorem ipsum dolor sit amet', $result);
    }
}
