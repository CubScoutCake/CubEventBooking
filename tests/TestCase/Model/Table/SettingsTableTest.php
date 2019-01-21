<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingsTable;
use Cake\I18n\Time;
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
        'app.setting_types',
        'app.events',
        'app.event_statuses',
        'app.discounts',
        'app.event_types',
        'app.section_types',
        'app.roles',
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

        $now = new Time('2016-12-26 23:22:30');
        Time::setTestNow($now);
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
        $result = $query->enableHydration(false)->toArray();

        $timeNow = Time::now();

        $expected = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 1,
                'number' => 1.0
            ],
            [
                'id' => 2,
                'name' => 'Lorem dolor sit amet',
                'text' => 'Lorem dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => null,
                'setting_type_id' => 2,
                'number' => 1.0
            ],
            [
                'id' => 3,
                'name' => 'LegalTxt',
                'text' => 'Legal Text',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 3,
                'number' => 1.0
            ],
            [
                'id' => 4,
                'name' => 'InvTxt',
                'text' => 'Invoice Text',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 4,
                'number' => 1.0
            ],
            [
                'id' => 5,
                'name' => 'Lorem ipsum sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 5,
                'number' => 1.0
            ],
            [
                'id' => 6,
                'name' => 'Application Reference',
                'text' => 'Team',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 6,
                'number' => 1.0
            ],
            [
                'id' => 7,
                'name' => 'Payment Reference',
                'text' => 'Payable to Cubs',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 7,
                'number' => 1.0
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
        $timeNow = Time::now();

        $badData = [
            'id' => null,
            'name' => null,
            'text' => null,
            'event_id' => 99,
            'setting_type_id' => 24,
            'number' => 'the fish'
        ];

        $goodData = [
            'id' => 7,
            'name' => 'Lorem Fishy dolor sit amet',
            'text' => 'Lorem ipsum Goaty sit amet',
            'created' => $timeNow,
            'modified' => $timeNow,
            'event_id' => null,
            'setting_type_id' => 1,
            'number' => 2.9
        ];

        $expected = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 1,
                'number' => 1.0
            ],
            [
                'id' => 2,
                'name' => 'Lorem dolor sit amet',
                'text' => 'Lorem dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => null,
                'setting_type_id' => 2,
                'number' => 1.0
            ],
            [
                'id' => 3,
                'name' => 'LegalTxt',
                'text' => 'Legal Text',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 3,
                'number' => 1.0
            ],
            [
                'id' => 4,
                'name' => 'InvTxt',
                'text' => 'Invoice Text',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 4,
                'number' => 1.0
            ],
            [
                'id' => 5,
                'name' => 'Lorem ipsum sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 5,
                'number' => 1.0
            ],
            [
                'id' => 6,
                'name' => 'Application Reference',
                'text' => 'Team',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 6,
                'number' => 1.0
            ],
            [
                'id' => 7,
                'name' => 'Lorem Fishy dolor sit amet',
                'text' => 'Lorem ipsum Goaty sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => null,
                'setting_type_id' => 1,
                'number' => 2.9
            ],
        ];

        $badEntity = $this->Settings->newEntity($badData);
        $goodEntity = $this->Settings->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->Settings->save($goodEntity);
        $this->assertFalse($this->Settings->save($badEntity));

        $query = $this->Settings->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testBuildRules()
    {
        $timeNow = Time::now();

        $badData = [
            'id' => 7,
            'name' => 'Lorem Fishy dolor sit amet',
            'text' => 'Lorem ipsum Goaty sit amet',
            'created' => $timeNow,
            'modified' => $timeNow,
            'event_id' => 1,
            'setting_type_id' => 109,
            'number' => 2.9
        ];

        $outData = [
            'id' => 7,
            'name' => 'Lorem Fishy dolor sit amet',
            'text' => 'Lorem ipsum Goaty sit amet',
            'created' => $timeNow,
            'modified' => $timeNow,
            'event_id' => 209,
            'setting_type_id' => 1,
            'number' => 2.9
        ];

        $goodData = [
            'id' => 7,
            'name' => 'Lorem Fishy dolor sit amet',
            'text' => 'Lorem ipsum Goaty sit amet',
            'created' => $timeNow,
            'modified' => $timeNow,
            'event_id' => 3,
            'setting_type_id' => 1,
            'number' => 2.9
        ];

        $expected = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 1,
                'number' => 1.0
            ],
            [
                'id' => 2,
                'name' => 'Lorem dolor sit amet',
                'text' => 'Lorem dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => null,
                'setting_type_id' => 2,
                'number' => 1.0
            ],
            [
                'id' => 3,
                'name' => 'LegalTxt',
                'text' => 'Legal Text',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 3,
                'number' => 1.0
            ],
            [
                'id' => 4,
                'name' => 'InvTxt',
                'text' => 'Invoice Text',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 4,
                'number' => 1.0
            ],
            [
                'id' => 5,
                'name' => 'Lorem ipsum sit amet',
                'text' => 'Lorem ipsum dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 5,
                'number' => 1.0
            ],
            [
                'id' => 6,
                'name' => 'Application Reference',
                'text' => 'Team',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 1,
                'setting_type_id' => 6,
                'number' => 1.0
            ],
            [
                'id' => 7,
                'name' => 'Lorem Fishy dolor sit amet',
                'text' => 'Lorem ipsum Goaty sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'event_id' => 3,
                'setting_type_id' => 1,
                'number' => 2.9
            ],
        ];

        $badEntity = $this->Settings->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $outEntity = $this->Settings->newEntity($outData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Settings->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Settings->save($badEntity));
        $this->assertFalse($this->Settings->save($outEntity));
        $this->Settings->save($goodEntity);

        $query = $this->Settings->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
