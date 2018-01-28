<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\SettingtypesTable Test Case
 */
class SettingtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SettingtypesTable
     */
    public $SettingTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.setting_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SettingTypes') ? [] : ['className' => 'App\Model\Table\SettingTypesTable'];
        $this->Settingtypes = TableRegistry::get('SettingTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Settingtypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Settingtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'setting_type' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 2,
                'setting_type' => 'Lorem ipsum  sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 3,
                'setting_type' => 'LegalText',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 4,
                'setting_type' => 'InvText',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 5,
                'setting_type' => 'Lorem ipsum dolor amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 6,
                'setting_type' => 'AppRef',
                'description' => 'Application Reference',
                'min_auth' => 1
            ],
            [
                'id' => 7,
                'setting_type' => 'Payable',
                'description' => 'Payable Reference',
                'min_auth' => 8
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
            'id' => null,
            'settingtype' => null,
            'description' => null
        ];

        $goodData = [
            'setting_type' => 'Lorem Fish dolor sit amet',
            'description' => 'Lorem Monkey dolor sit amet',
            'min_auth' => 1
        ];

        $expected = [
            [
                'id' => 1,
                'setting_type' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 2,
                'setting_type' => 'Lorem ipsum  sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 3,
                'setting_type' => 'LegalText',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 4,
                'setting_type' => 'InvText',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 5,
                'setting_type' => 'Lorem ipsum dolor amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'min_auth' => 1
            ],
            [
                'id' => 6,
                'setting_type' => 'AppRef',
                'description' => 'Application Reference',
                'min_auth' => 1
            ],
            [
                'id' => 7,
                'setting_type' => 'Payable',
                'description' => 'Payable Reference',
                'min_auth' => 8
            ],
            [
                'id' => 8,
                'setting_type' => 'Lorem Fish dolor sit amet',
                'description' => 'Lorem Monkey dolor sit amet',
                'min_auth' => 1
            ]
        ];

        $badEntity = $this->Settingtypes->newEntity($badData);
        //$inaccessibleEntity = $this->Settingtypes->newEntity($goodData);
        $goodEntity = $this->Settingtypes->newEntity($goodData);

        $this->assertFalse($this->Settingtypes->save($badEntity));
        //$this->assertFalse($this->Settingtypes->save($inaccessibleEntity));
        $this->Settingtypes->save($goodEntity);

        $query = $this->Settingtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
