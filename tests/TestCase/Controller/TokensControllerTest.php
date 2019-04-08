<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TokensController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TokensController Test Case
 */
class TokensControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.email_responses',
        'app.email_sends',
        'app.users',
        'app.password_states',
        'app.roles',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.tokens',
        'app.email_response_types',
        'app.tokens',
    ];

    /**
     * Test view method
     *
     * @return void
     *
     * @throws
     */
    public function testValidate()
    {
        /** @var \App\Model\Table\TokensTable $tokens */
        $tokens = TableRegistry::getTableLocator()->get('Tokens');

        $token = $tokens->prepareToken(1);

        $this->get([
            'controller' => 'Tokens',
            'action' => 'validate',
            'prefix' => false,
            urlencode($token)
        ]);

        $this->assertRedirect([
            'controller' => 'Applications',
            'action' => 'view',
            'prefix' => false,
            1,
            '?' => [
                'token_id' => 1,
                'token' => $token,
            ]
        ]);
    }
}
