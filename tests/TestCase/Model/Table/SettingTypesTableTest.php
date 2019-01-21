<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SettingTypesTable Test Case
 */
class SettingTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SettingTypesTable
     */
    public $SettingTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.setting_types',
        'app.settings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SettingTypes') ? [] : ['className' => SettingTypesTable::class];
        $this->SettingTypes = TableRegistry::getTableLocator()->get('SettingTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SettingTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
