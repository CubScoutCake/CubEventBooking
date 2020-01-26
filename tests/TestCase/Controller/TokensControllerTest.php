<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TokensController Test Case
 */
class TokensControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
        'app.users',
        'app.notification_types',
        'app.notifications',
        'app.application_statuses',
        'app.setting_types',
        'app.settings',
        'app.event_types',
        'app.event_statuses',
        'app.discounts',
        'app.events',
        'app.prices',
        'app.applications',
        'app.task_types',
        'app.tasks',
        'app.attendees',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.reservation_statuses',
        'app.reservations',
        'app.invoices',
        'app.invoice_items',
        'app.payments',
        'app.invoices_payments',
        'app.notes',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.logistics',
        'app.logistic_items',
        'app.email_sends',
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
            $token,
        ]);

        $this->assertRedirect([
            'controller' => 'Applications',
            'action' => 'view',
            'prefix' => false,
            1,
            '?' => [
                'token_id' => 1,
                'token' => $token,
            ],
        ]);
    }
}
