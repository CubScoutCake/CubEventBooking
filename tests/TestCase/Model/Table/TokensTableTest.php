<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TokensTable;
use App\Utility\TextSafe;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
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
        'app.allergies',
        'app.application_statuses',
        'app.applications',
        'app.applications_attendees',
        'app.attendees',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.champions',
        'app.discounts',
        'app.districts',
        'app.email_response_types',
        'app.email_responses',
        'app.email_sends',
        'app.event_statuses',
        'app.event_types',
        'app.events',
        'app.invoice_items',
        'app.invoices',
        'app.invoices_payments',
        'app.item_types',
        'app.logistic_items',
        'app.logistics',
        'app.notes',
        'app.notification_types',
        'app.notifications',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.password_states',
        'app.payments',
        'app.prices',
        'app.reservation_statuses',
        'app.reservations',
        'app.roles',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.sessions',
        'app.setting_types',
        'app.settings',
        'app.task_types',
        'app.tasks',
        'app.tokens',
        'app.users',
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

        $now = new FrozenTime('2016-12-26 23:22:30');
        FrozenTime::setTestNow($now);

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
                $this->assertInstanceOf('Cake\I18n\FrozenTime', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'random_number' => 54498,
            'token_header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                    1
                ],
                'authenticate' => false,
            ]
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
        $token = $this->Tokens->buildToken(1);
        $token = urldecode($token);
        $token = TextSafe::decode($token);

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
