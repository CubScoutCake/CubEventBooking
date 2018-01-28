<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SectionsTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SectionsTable Test Case
 */
class SectionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SectionsTable
     */
    public $Sections;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
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
        $config = TableRegistry::exists('Sections') ? [] : ['className' => 'App\Model\Table\SectionsTable'];
        $this->Sections = TableRegistry::get('Sections', $config);

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
        unset($this->Sections);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Sections->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $startNow = Time::now();
        $modifiedDate = $startNow->modify('-3 days');
        $createdDate = $startNow->modify('-2 hours');

        $expected = [
            [
                'id' => 1,
                'created' => $createdDate,
                'modified' => $modifiedDate,
                'deleted' => null,
                'section' => 'Lorem ipsum dolor sit amet',
                'section_type_id' => 1,
                'scoutgroup_id' => 1,
                'validated' => true,
                'cc_users' => null,
                'cc_atts' => null,
                'cc_apps' => null,
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
        $startNow = Time::now();
        $modifiedDate = $startNow->modify('-3 days');
        $createdDate = $startNow->modify('-2 hours');

        $badData = [
            'created' => $createdDate,
            'modified' => $modifiedDate,
            'deleted' => null,
            'section' => null,
            'section_type_id' => 1,
            'scoutgroup_id' => 1
        ];

        $goodData = [
            'created' => $createdDate,
            'modified' => $modifiedDate,
            'deleted' => null,
            'section' => 'Lorem LASO sit amet',
            'section_type_id' => 1,
            'scoutgroup_id' => 1
        ];

        $expected = [
            [
                'id' => 1,
                'created' => $createdDate,
                'modified' => $modifiedDate,
                'deleted' => null,
                'section' => 'Lorem ipsum dolor sit amet',
                'section_type_id' => 1,
                'scoutgroup_id' => 1,
                'validated' => true,
                'cc_users' => null,
                'cc_atts' => null,
                'cc_apps' => null,
            ],
            [
                'id' => 3,
                'created' => $createdDate,
                'modified' => $modifiedDate,
                'deleted' => null,
                'section' => 'Lorem LASO sit amet',
                'section_type_id' => 1,
                'scoutgroup_id' => 1,
                'validated' => false,
                'cc_users' => null,
                'cc_atts' => null,
                'cc_apps' => null,
            ],
        ];

        $badEntity = $this->Sections->newEntity($badData);
        $goodEntity = $this->Sections->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Sections->save($badEntity));
        $this->Sections->save($goodEntity);

        $query = $this->Sections->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $startNow = Time::now();
        $modifiedDate = $startNow->modify('-3 days');
        $createdDate = $startNow->modify('-2 hours');

        $badData = [
            'created' => $createdDate,
            'modified' => $modifiedDate,
            'deleted' => null,
            'section' => 'Lorem LASO sit amet',
            'section_type_id' => 288,
            'scoutgroup_id' => 912
        ];

        $goodData = [
            'created' => $createdDate,
            'modified' => $modifiedDate,
            'deleted' => null,
            'section' => 'Lorem LASO sit amet',
            'section_type_id' => 1,
            'scoutgroup_id' => 1
        ];

        $expected = [
            [
                'id' => 1,
                'created' => $createdDate,
                'modified' => $modifiedDate,
                'deleted' => null,
                'section' => 'Lorem ipsum dolor sit amet',
                'section_type_id' => 1,
                'scoutgroup_id' => 1,
                'validated' => true,
                'cc_users' => null,
                'cc_atts' => null,
                'cc_apps' => null,
            ],
            [
                'id' => 3,
                'created' => $createdDate,
                'modified' => $modifiedDate,
                'deleted' => null,
                'section' => 'Lorem LASO sit amet',
                'section_type_id' => 1,
                'scoutgroup_id' => 1,
                'validated' => false,
                'cc_users' => null,
                'cc_atts' => null,
                'cc_apps' => null,
            ],
        ];

        $badEntity = $this->Sections->newEntity($badData);
        $goodEntity = $this->Sections->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Sections->save($badEntity));
        $this->Sections->save($goodEntity);

        $query = $this->Sections->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
