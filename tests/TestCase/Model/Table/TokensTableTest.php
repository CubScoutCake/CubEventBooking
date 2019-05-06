<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TokensTable;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;
use Cake\Utility\Security;

/**
 * App\Model\Table\TokensTable Test Case
 *
 * @property bool $travisPass
 */
class TokensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TokensTable
     */
    public $Tokens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Allergies',
        'app.ApplicationStatuses',
        'app.Applications',
        'app.ApplicationsAttendees',
        'app.Attendees',
        'app.AttendeesAllergies',
        'app.AuthRoles',
        'app.Champions',
        'app.Discounts',
        'app.Districts',
        'app.EmailResponseTypes',
        'app.EmailResponses',
        'app.EmailSends',
        'app.EventStatuses',
        'app.EventTypes',
        'app.Events',
        'app.InvoiceItems',
        'app.Invoices',
        'app.InvoicesPayments',
        'app.ItemTypes',
        'app.LogisticItems',
        'app.Logistics',
        'app.Notes',
        'app.NotificationTypes',
        'app.Notifications',
        'app.ParameterSets',
        'app.Parameters',
        'app.Params',
        'app.PasswordStates',
        'app.Payments',
        'app.Prices',
        'app.ReservationStatuses',
        'app.Reservations',
        'app.Roles',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.Sessions',
        'app.SettingTypes',
        'app.Settings',
        'app.TaskTypes',
        'app.Tasks',
        'app.Tokens',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Tokens') ? [] : ['className' => TokensTable::class];
        $this->Tokens = TableRegistry::getTableLocator()->get('Tokens', $config);

        $now = new Time('2016-12-26 23:22:30');
        Time::setTestNow($now);

        $this->travisPass = false; //Configure::read('travis');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tokens);
        unset($this->travisPass);

        parent::tearDown();
    }

    /**
     * Get Good Entity Data
     *
     * @return array
     *
     * @throws
     */
    private function getGood()
    {
        return [
            'token' => 'Password Reset for Jacob',
            'email_send_id' => 1,
            'active' => true,
            'random_number' => 1789,
            'token_header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                    1
                ],
                'authenticate' => true,
            ]
        ];
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        $actual = $this->Tokens->get(1)->toArray();

        $dates = [
            'expires',
            'created',
            'modified',
            'utilised',
            'deleted',
        ];

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\Time', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'random_number' => 54498,
            'token_header' => null
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Tokens->find('all')->count();
        $this->assertEquals(1, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        $good = $this->getGood();

        $new = $this->Tokens->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\Token', $this->Tokens->save($new));

        $required = [
            'token',
            'token_header',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Tokens->newEntity($reqArray);
            $this->assertFalse($this->Tokens->save($new));
        }

        $notRequired = [
            'expires',
            'utilised',
        ];

        foreach ($notRequired as $notRequire) {
            $reqArray = $this->getGood();
            unset($reqArray[$notRequire]);
            $new = $this->Tokens->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Token', $this->Tokens->save($new));
        }

        $empties = [
            'expires',
            'utilised',
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->Tokens->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Token', $this->Tokens->save($new));
        }

        $notEmpties = [
            'token',
            'token_header',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->Tokens->newEntity($reqArray);
            $this->assertFalse($this->Tokens->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        // Email Send Exists
        $values = $this->getGood();

        $sends = $this->Tokens->EmailSends->find('list')->toArray();

        $send = max(array_keys($sends));

        $values['email_send_id'] = $send;
        $new = $this->Tokens->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Token', $this->Tokens->save($new));

        $values['email_send_id'] = $send + 1;
        $new = $this->Tokens->newEntity($values);
        $this->assertFalse($this->Tokens->save($new));
    }

    /**
     * Test the Build Token
     */
    public function testBuildToken()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        $token = $this->Tokens->buildToken(1);
        $token = urldecode($token);
        //$token = gzuncompress($token);

        $this->assertGreaterThanOrEqual(32, strlen($token), 'Token is too short.');

        $decrypter = substr($token, 0, 8);
        $this->assertEquals(8, strlen($decrypter));

        $token = substr($token, 8);

        $token = base64_decode($token);
        $token = json_decode($token);

        $data = [
            'id' => 1,
            'random_number' => 54498,
        ];

        $this->assertEquals($data['id'], $token->id);

        $this->assertEquals($data['random_number'], $token->random_number);
        $this->assertTrue(is_numeric($token->random_number));
    }

    public function testBeforeSave()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        $goodData = [
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
            'token_header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                ],
                'authenticate' => true,
            ]
        ];

        $expected = [
            'id' => 2,
            'email_send_id' => 1,
            'active' => true,
            'token_header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                ],
                'authenticate' => true,
            ]
        ];

        $goodEntity = $this->Tokens->newEntity($goodData);

        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->get(2, [
            'fields' => [
                'id',
                'email_send_id',
                'active',
                'token_header',
            ]
        ]);

        $result = $query->toArray();

        $this->assertEquals($expected, $result);

        $query = $this->Tokens->get(2, [
            'fields' => [
                'random_number',
                'active'
            ]
        ]);

        $result = $query->toArray();

        $this->assertTrue(is_numeric($result['random_number']));
        $this->assertTrue($result['active']);
    }

    public function testValidateToken()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        $goodData = [
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
            'token_header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                ],
                'authenticate' => true,
            ]
        ];

        $expected = [
            'id' => 2,
            'email_send_id' => 1,
            'active' => true,
        ];

        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->get(2, [
            'fields' => [
                'id',
                'email_send_id',
                'active',
            ]
        ]);

        $result = $query->toArray();

        $this->assertEquals($expected, $result);

        $query = $this->Tokens->get(2, [
            'fields' => [
                'random_number',
                'active'
            ]
        ]);

        $result = $query->toArray();

        $this->assertTrue(is_numeric($result['random_number']));
        $this->assertTrue($result['active']);

        $token = $this->Tokens->buildToken(2);

        $result = $this->Tokens->validateToken($token);

        $this->assertNotFalse($result);
        $this->assertTrue(is_numeric($result));

        $incorrectToken = substr($token, 25, 256);

        $result = $this->Tokens->validateToken($incorrectToken);

        $this->assertFalse($result);
        $this->assertNotTrue(is_numeric($result));
    }
}
