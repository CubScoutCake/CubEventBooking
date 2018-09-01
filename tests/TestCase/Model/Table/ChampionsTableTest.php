<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChampionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\ChampionsTable Test Case
 */
class ChampionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChampionsTable
     */
    public $Champions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.champions',
        'app.districts',
        'app.password_states',
        'app.scoutgroups',
        'app.users',
        'app.roles',
        'app.auth_roles',
        'app.sections',
        'app.section_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Champions') ? [] : ['className' => 'App\Model\Table\ChampionsTable'];
        $this->Champions = TableRegistry::get('Champions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Champions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Champions->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'district_id' => 1,
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'email' => 'jacob@fish.com',
                'user_id' => 1,
                'deleted' => null
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
            'id' => 3,
            'district_id' => null,
            'firstname' => null,
            'lastname' => null,
            'email' => 'Jacob@Fish.com',
            'user_id' => null,
            'deleted' => null
        ];

        $badEmailData = [
            'id' => 3,
            'district_id' => null,
            'firstname' => null,
            'lastname' => null,
            'email' => 'this is a goat',
            'user_id' => null,
            'deleted' => null
        ];

        $goodData = [
            'id' => 3,
            'district_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Jacob@GOAT.com',
            'user_id' => 1,
            'deleted' => null
        ];

        $expected = [
            [
                'id' => 1,
                'district_id' => 1,
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'email' => 'jacob@fish.com',
                'user_id' => 1,
                'deleted' => null
            ],
            [
                'id' => 3,
                'district_id' => 1,
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'email' => 'jacob@goat.com',
                'user_id' => 1,
                'deleted' => null
            ],
        ];

        $badEntity = $this->Champions->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $badEmailEntity = $this->Champions->newEntity($badEmailData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Champions->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Champions->save($badEntity));
        $this->assertFalse($this->Champions->save($badEmailEntity));
        $this->Champions->save($goodEntity);

        $query = $this->Champions->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $badEmailData = [
            'id' => 3,
            'district_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'email' => 'jacob@FISH.com',
            'user_id' => 1,
            'deleted' => null
        ];

        $badDistrictData = [
            'id' => 3,
            'district_id' => 12342,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'email' => 'jacob@goat.com',
            'user_id' => 1,
            'deleted' => null
        ];

        $badUserData = [
            'id' => 3,
            'district_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Jacob@Goat.com',
            'user_id' => 2,
            'deleted' => null
        ];

        $goodData = [
            'id' => 3,
            'district_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'email' => 'Jacob@goat.com',
            'user_id' => 1,
            'deleted' => null
        ];

        $expected = [
            [
                'id' => 1,
                'district_id' => 1,
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'email' => 'jacob@fish.com',
                'user_id' => 1,
                'deleted' => null
            ],
            [
                'id' => 3,
                'district_id' => 1,
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'email' => 'jacob@goat.com',
                'user_id' => 1,
                'deleted' => null
            ],
        ];

        $badEmailEntity = $this->Champions->newEntity($badEmailData, ['accessibleFields' => ['id' => true]]);
        $badUserEntity = $this->Champions->newEntity($badUserData, ['accessibleFields' => ['id' => true]]);
        $badDistrictEntity = $this->Champions->newEntity($badDistrictData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Champions->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Champions->save($badEmailEntity));
        $this->assertFalse($this->Champions->save($badUserEntity));
        $this->assertFalse($this->Champions->save($badDistrictEntity));

        $this->Champions->save($goodEntity);

        $query = $this->Champions->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
