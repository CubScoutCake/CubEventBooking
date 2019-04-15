<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TokensTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;
use Cake\Utility\Security;

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
//        'app.email_sends',
//        'app.notification_types',
//        'app.notifications',
//
//        'app.users',
//        'app.roles',
//        'app.auth_roles',
//        'app.districts',
//        'app.scoutgroups',
//        'app.section_types',
//        'app.sections',
//        'app.password_states',
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
     * Get Good Entity Data
     *
     * @return array
     *
     * @throws
     */
    private function getGood()
    {
        return [
            'user_id' => 1,
            'token' => 'Password Reset for Jacob',
            'email_send_id' => 1,
            'active' => true,
            'random_number' => 1789,
            'header' => [
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
                $this->assertInstanceOf('Cake\I18n\Time', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'random_number' => 1789,
            'header' => ''
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
            'user_id',
            'header',
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
            'user_id',
            'header',
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
        // Token Type Exists
        $values = $this->getGood();

        $types = $this->Tokens->Users->find('list')->toArray();

        $type = max(array_keys($types));

        $values['user_id'] = $type;
        $new = $this->Tokens->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Token', $this->Tokens->save($new));

        $values['user_id'] = $type + 1;
        $new = $this->Tokens->newEntity($values);
        $this->assertFalse($this->Tokens->save($new));

        // User Exists
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
        //$token = gzuncompress($token);

        $this->assertGreaterThanOrEqual(32, strlen($token), 'Token is too short.');

        $decrypter = substr($token, 0, 8);
        $this->assertEquals(8, strlen($decrypter));

        $token = substr($token, 8);

        $token = base64_decode($token);
        $token = json_decode($token);

        $data = [
            'id' => 1,
            'random_number' => 1789,
        ];

        $this->assertEquals($data['id'], $token->id);

        $this->assertEquals($data['random_number'], $token->random_number);
        $this->assertTrue(is_numeric($token->random_number));
    }

    public function testBeforeSave()
    {
        $goodData = [
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
            'header' => [
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
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'header' => [
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
                'user_id',
                'email_send_id',
                'active',
                'header',
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
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
            'header' => [
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
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
        ];

        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->get(2, [
            'fields' => [
                'id',
                'user_id',
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
