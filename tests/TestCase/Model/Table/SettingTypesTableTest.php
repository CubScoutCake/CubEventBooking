<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

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
     * Get Good Set Function
     *
     * @return array
     *
     * @throws
     */
    private function getGood()
    {
        $good = [
            'setting_type' => 'Max Cheese ' . random_int(111, 999) . ' ' . random_int(111, 999),
            'description' => 'The largest limit of Cheese',
            'min_auth' => 1
        ];

        return $good;
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $actual = $this->SettingTypes->get(1)->toArray();

        $expected = [
            'id' => 1,
            'setting_type' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet',
            'min_auth' => 1
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->SettingTypes->find('all')->count();
        $this->assertEquals(7, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->SettingTypes->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\SettingType', $this->SettingTypes->save($new));

        $required = [
            'setting_type',
            'min_auth'
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->SettingTypes->newEntity($reqArray);
            $this->assertFalse($this->SettingTypes->save($new));
        }

        $notRequired = [
            'description',
        ];

        foreach ($notRequired as $notRequire) {
            $reqArray = $this->getGood();
            unset($reqArray[$notRequire]);
            $new = $this->SettingTypes->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\SettingType', $this->SettingTypes->save($new));
        }

        $empties = [
            'description',
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->SettingTypes->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\SettingType', $this->SettingTypes->save($new));
        }

        $notEmpties = [
            'setting_type',
            'min_auth',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->SettingTypes->newEntity($reqArray);
            $this->assertFalse($this->SettingTypes->save($new));
        }

        $maxLengths = [
            'setting_type' => 45,
            'description' => 255,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->SettingTypes->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\SettingType', $this->SettingTypes->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->SettingTypes->newEntity($reqArray);
            $this->assertFalse($this->SettingTypes->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $values = $this->getGood();

        $existing = $this->SettingTypes->get(1)->toArray();

        $values['setting_type'] = 'My new Camp Role Type';
        $new = $this->SettingTypes->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\SettingType', $this->SettingTypes->save($new));

        $values['setting_type'] = $existing['setting_type'];
        $new = $this->SettingTypes->newEntity($values);
        $this->assertFalse($this->SettingTypes->save($new));
    }
}
