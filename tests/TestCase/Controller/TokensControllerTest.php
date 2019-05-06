<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TokensController;
use Cake\Core\Configure;
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
        'app.Districts',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.PasswordStates',
        'app.AuthRoles',
        'app.ItemTypes',
        'app.Roles',
        'app.Users',
        'app.NotificationTypes',
        'app.Notifications',
        'app.ApplicationStatuses',
        'app.SettingTypes',
        'app.Settings',
        'app.EventTypes',
        'app.EventStatuses',
        'app.Discounts',
        'app.Events',
        'app.Prices',
        'app.Applications',
        'app.TaskTypes',
        'app.Tasks',
        'app.Attendees',
        'app.ApplicationsAttendees',
        'app.Allergies',
        'app.AttendeesAllergies',
        'app.ReservationStatuses',
        'app.Reservations',
        'app.Invoices',
        'app.InvoiceItems',
        'app.Payments',
        'app.InvoicesPayments',
        'app.Notes',
        'app.ParameterSets',
        'app.Parameters',
        'app.Params',
        'app.Logistics',
        'app.LogisticItems',
        'app.EmailSends',
        'app.Tokens',
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
        if (Configure::read('travis')) {
            $this->markTestSkipped('Token odd behaviour!');
        }

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
