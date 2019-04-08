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
        'app.tasks',
        'app.task_types',
        'app.allergies',
        'app.application_statuses',
        'app.applications_attendees',
        'app.applications',
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
        'app.setting_types',
        'app.settings',
        'app.users',
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

        $token = $tokens->buildToken(1);

        $this->get([
            'controller' => 'Tokens',
            'action' => 'validate',
            'prefix' => false,
            $token
        ]);

        $this->assertRedirect([
            'controller' => 'Applications',
            'action' => 'view',
            'prefix' => false,
            1,
            '?' => [
                'token' => $token,
                'token_id' => 1
            ]
        ]);
    }
}
