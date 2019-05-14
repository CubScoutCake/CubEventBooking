<?php
namespace App\Test\TestCase\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

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
        'app.Sections',
        'app.SectionTypes',
        'app.Scoutgroups',
        'app.Districts',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Sections') ? [] : ['className' => 'App\Model\Table\SectionsTable'];
        $this->Sections = TableRegistry::getTableLocator()->get('Sections', $config);

        $now = new FrozenTime('2016-12-26 23:22:30');
        FrozenTime::setTestNow($now);
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
     * Get Good Set Function
     *
     * @return array
     *
     * @throws
     */
    private function getGood()
    {
        return [
            'section' => 'Section ' . random_int(0, 999) . random_int(0, 99),
            'section_type_id' => 1,
            'scoutgroup_id' => 1,
            'validated' => true,
            'cc_users' => null,
            'cc_atts' => null,
            'cc_apps' => null,
        ];
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $actual = $this->Sections->get(1)->toArray();

        $dates = [
            'modified',
            'created',
            'deleted',
        ];

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\FrozenTime', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'section' => 'Lorem ipsum dolor sit amet',
            'section_type_id' => 1,
            'scoutgroup_id' => 1,
            'validated' => true,
            'cc_users' => null,
            'cc_atts' => null,
            'cc_apps' => null,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Sections->find('all')->count();
        $this->assertEquals(2, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->Sections->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\Section', $this->Sections->save($new));

        $required = [
            'section',
            'section_type_id',
            'scoutgroup_id',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Sections->newEntity($reqArray);
            $this->assertFalse($this->Sections->save($new));
        }

        $notEmpties = [
            'section',
            'section_type_id',
            'scoutgroup_id',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->Sections->newEntity($reqArray);
            $this->assertFalse($this->Sections->save($new));
        }

        $maxLengths = [
            'section' => 255,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->Sections->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Section', $this->Sections->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->Sections->newEntity($reqArray);
            $this->assertFalse($this->Sections->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // Scout Group Exists
        $values = $this->getGood();

        $types = $this->Sections->Scoutgroups->find('list')->toArray();

        $type = max(array_keys($types));

        $values['scoutgroup_id'] = $type;
        $new = $this->Sections->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Section', $this->Sections->save($new));

        $values['scoutgroup_id'] = $type + 1;
        $new = $this->Sections->newEntity($values);
        $this->assertFalse($this->Sections->save($new));

        // Section Type Exists
        $values = $this->getGood();

        $types = $this->Sections->SectionTypes->find('list')->toArray();

        $type = max(array_keys($types));

        $values['section_type_id'] = $type;
        $new = $this->Sections->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Section', $this->Sections->save($new));

        $values['section_type_id'] = $type + 1;
        $new = $this->Sections->newEntity($values);
        $this->assertFalse($this->Sections->save($new));
    }
}
