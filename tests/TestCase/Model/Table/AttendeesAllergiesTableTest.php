<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendeesAllergiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\AttendeesAllergiesTable Test Case
 */
class AttendeesAllergiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendeesAllergiesTable
     */
    public $AttendeesAllergies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendees_allergies',
        'app.attendees',
        'app.allergies',
        'app.roles',
        'app.section_types',
        'app.sections',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.districts',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AttendeesAllergies') ? [] : ['className' => 'App\Model\Table\AttendeesAllergiesTable'];
        $this->AttendeesAllergies = TableRegistry::get('AttendeesAllergies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttendeesAllergies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->AttendeesAllergies->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'attendee_id' => 1,
                'allergy_id' => 1
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $badData = [
            'attendee_id' => 99,
            'allergy_id' => 99
        ];

        $goodData = [
            'attendee_id' => 1,
            'allergy_id' => 2
        ];

        $expected = [
            [
                'attendee_id' => 1,
                'allergy_id' => 1
            ],
            [
                'attendee_id' => 1,
                'allergy_id' => 2
            ]
        ];

        $badEntity = $this->AttendeesAllergies->newEntity($badData, ['accessibleFields' => ['allergy_id' => true, 'attendee_id' => true]]);
        $goodEntity = $this->AttendeesAllergies->newEntity($goodData, ['accessibleFields' => ['allergy_id' => true, 'attendee_id' => true]]);

        $this->assertFalse($this->AttendeesAllergies->save($badEntity), '');
        $this->AttendeesAllergies->save($goodEntity);

        $query = $this->AttendeesAllergies->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
