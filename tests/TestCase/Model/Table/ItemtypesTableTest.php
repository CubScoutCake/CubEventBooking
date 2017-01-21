<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemTypesTable Test Case
 */
class ItemTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemTypesTable
     */
    public $ItemTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.events',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.notes',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.payments',
        'app.invoices_payments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemTypes') ? [] : ['className' => 'App\Model\Table\ItemTypesTable'];
        $this->ItemTypes = TableRegistry::get('ItemTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Itemtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'minor' => true,
                'item_type' => 'Lorem ipsum dolor sit amet',
                'role_id' => 1,
                'cancelled' => true,
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
            'itemtype' => null,
            'roletype' => null,
            'minor' => null
        ];

        $goodData = [
            'id' => 2,
            'minor' => true,
            'item_type' => 'Lorem dolor goat amet',
            'role_id' => 1,
            'cancelled' => false,
        ];

        $expected = [
            [
                'id' => 1,
                'minor' => true,
                'item_type' => 'Lorem ipsum dolor sit amet',
                'role_id' => 1,
                'cancelled' => true,
            ],
            [
                'id' => 2,
                'minor' => true,
                'item_type' => 'Lorem dolor goat amet',
                'role_id' => 1,
                'cancelled' => false,
            ],
        ];

        $badEntity = $this->Itemtypes->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Itemtypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Itemtypes->save($badEntity));
        $this->Itemtypes->save($goodEntity);

        $query = $this->Itemtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
