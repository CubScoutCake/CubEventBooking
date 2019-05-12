<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\ModelLevel\Table\NotificationTypesTable Test Case
 */
class NotificationTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationTypesTable
     */
    public $NotificationTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notification_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NotificationTypes') ? [] : ['className' => 'App\Model\Table\NotificationTypesTable'];
        $this->NotificationTypes = TableRegistry::get('NotificationTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NotificationTypes);

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
            'notification_type' => 'Notification ' . random_int(11111, 99999) . ' dolor ' . random_int(11111, 99999) . ' amet',
            'notification_description' => 'Balance Outstanding on Invoice',
            'icon' => 'fa-clock',
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
        $actual = $this->NotificationTypes->get(1)->toArray();

        $expected = [
            'id' => 1,
            'notification_type' => 'Welcome',
            'notification_description' => 'Welcome to the System Email & Notification.',
            'icon' => 'fa-user'
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->NotificationTypes->find('all')->count();
        $this->assertEquals(9, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->NotificationTypes->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\NotificationType', $this->NotificationTypes->save($new));

        $required = [
            'notification_type',
            'icon',
            'notification_description',
        ];

        foreach ($required as $require) {
            $reqArray = $good;
            unset($reqArray[$require]);
            $new = $this->NotificationTypes->newEntity($reqArray);
            $this->assertFalse($this->NotificationTypes->save($new));
        }

        $empties = [
        ];

        foreach ($empties as $empty) {
            $reqArray = $good;
            $reqArray[$empty] = '';
            $new = $this->NotificationTypes->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\NotificationType', $this->NotificationTypes->save($new));
        }

        $notEmpties = [
            'notification_type',
            'icon',
            'notification_description',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $good;
            $reqArray[$notEmpty] = '';
            $new = $this->NotificationTypes->newEntity($reqArray);
            $this->assertFalse($this->NotificationTypes->save($new));
        }

        $maxLengths = [
            'notification_description' => 255,
            'notification_type' => 45,
            'icon' => 45,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->NotificationTypes->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\NotificationType', $this->NotificationTypes->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->NotificationTypes->newEntity($reqArray);
            $this->assertFalse($this->NotificationTypes->save($new));
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

        $existing = $this->NotificationTypes->get(1)->toArray();

        $values['notification_type'] = 'My new Camp Role Type';
        $new = $this->NotificationTypes->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\NotificationType', $this->NotificationTypes->save($new));

        $values['notification_type'] = $existing['notification_type'];
        $new = $this->NotificationTypes->newEntity($values);
        $this->assertFalse($this->NotificationTypes->save($new));
    }
}
