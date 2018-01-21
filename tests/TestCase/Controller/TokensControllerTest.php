<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TokensController;
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
        'app.email_response_types'
    ];

    /**
     * Test view method
     *
     * @return void
     */
    public function testValidate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
