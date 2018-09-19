<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TokensTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;

/**
 * App\Model\Table\TokensTable Test Case
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
        'app.tokens',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications', 'app.application_statuses',
        'app.password_states',
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.event_types',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.notes',
        'app.payments',
        'app.invoices_payments',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.email_sends',
        'app.email_responses',
        'app.email_response_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tokens') ? [] : ['className' => 'App\Model\Table\TokensTable'];
        $this->Tokens = TableRegistry::get('Tokens', $config);

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
        unset($this->Tokens);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $startNow = Time::now();

        $query = $this->Tokens->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'token' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'expires' => $startNow,
                'utilised' => $startNow,
                'active' => 1,
                'deleted' => null,
                'hash' => 'Lorem ipsum dolor sit amet',
                'random_number' => 1,
                'header' => 'Lorem ipsum dolor sit amet'
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

        $badData = [
            'id' => 6,
            'token' => 'Lorem ipsum dolor sit',
            'user_id' => null,
            'email_send_id' => null,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit amet',
            'random_number' => 1,
            'header' => 'Lorem ipsum dolor amet'
        ];

        $goodData = [
            'token' => 'Lorem ipsum dolor sit',
            'user_id' => 1,
            'email_send_id' => 1,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit amet',
            'random_number' => 12,
            'header' => 'Lorem ipsum sk sit amet'
        ];

        $expected = [
            [
                'id' => 1,
                'token' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => $startNow,
                'active' => 1,
                'deleted' => null,
                'hash' => 'Lorem ipsum dolor sit amet',
                'header' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'id' => 3,
                'token' => 'Lorem ipsum dolor sit',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => null,
                'active' => true,
                'deleted' => null,
                'hash' => 'Lorem dolor sit amet',
                'header' => 'Lorem ipsum sk sit amet'
            ],
        ];

        $badEntity = $this->Tokens->newEntity($badData);
        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Tokens->save($badEntity));
        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->find('all', [
            'fields' => [
                'id',
                'token',
                'user_id',
                'email_send_id',
                'created',
                'modified',
                'utilised',
                'active',
                'deleted',
                'hash',
                'header',
            ]
        ]);

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
        $startNow = Time::now();

        $badData = [
            'id' => 8,
            'token' => 'Lorem dolor sit',
            'user_id' => 109,
            'email_send_id' => 109,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit amet',
            'random_number' => 12,
            'header' => 'Lorem ipsum sk sit amet'
        ];

        $goodData = [
            'id' => 9,
            'token' => 'Lorem sit',
            'user_id' => 1,
            'email_send_id' => 1,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit',
            'random_number' => 12,
            'header' => 'Lorem ipsum sk amet'
        ];

        $expected = [
            [
                'id' => 1,
                'token' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => $startNow,
                'active' => 1,
                'deleted' => null,
                'hash' => 'Lorem ipsum dolor sit amet',
                'header' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'id' => 9,
                'token' => 'Lorem sit',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => null,
                'active' => true,
                'deleted' => null,
                'hash' => 'Lorem dolor sit',
                'header' => 'Lorem ipsum sk amet'
            ],
        ];

        $badEntity = $this->Tokens->newEntity($badData);
        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Tokens->save($badEntity));
        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->find('all', [
            'fields' => [
                'id',
                'token',
                'user_id',
                'email_send_id',
                'created',
                'modified',
                'utilised',
                'active',
                'deleted',
                'hash',
                'header',
            ]
        ]);

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the Build Token
     */
    public function testBuildToken()
    {
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
            'random_number' => 1,
        ];

        $this->assertEquals($data['id'], $token->id);

        $this->assertEquals($data['random_number'], $token->random_number);
        $this->assertTrue(is_numeric($token->random_number));
    }

    public function testBeforeSave()
    {
        $goodData = [
            'id' => 3,
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
        ];

        $expected = [
            'id' => 3,
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
        ];

        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->get(3, [
            'fields' => [
                'id',
                'user_id',
                'email_send_id',
                'active',
            ]
        ]);

        $result = $query->toArray();

        $this->assertEquals($expected, $result);

        $query = $this->Tokens->get(3, [
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
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
        ];

        $expected = [
            'id' => 3,
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
        ];

        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->get(3, [
            'fields' => [
                'id',
                'user_id',
                'email_send_id',
                'active',
            ]
        ]);

        $result = $query->toArray();

        $this->assertEquals($expected, $result);

        $query = $this->Tokens->get(3, [
            'fields' => [
                'random_number',
                'active'
            ]
        ]);

        $result = $query->toArray();

        $this->assertTrue(is_numeric($result['random_number']));
        $this->assertTrue($result['active']);

        $token = $this->Tokens->buildToken(3);

        $result = $this->Tokens->validateToken($token);

        $this->assertNotFalse($result);
        $this->assertTrue(is_numeric($result));

        $incorrectToken = substr($token, 25, 256);

        $result = $this->Tokens->validateToken($incorrectToken);

        $this->assertFalse($result);
        $this->assertNotTrue(is_numeric($result));
    }
}
