<?php
declare(strict_types=1);

namespace App\Test\TestCase\Command;

use Cake\Console\Command;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Class UpdateTableCommandTest
 *
 * @package App\Test\TestCase\Command
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class UpdateTableCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.application_statuses',
        'app.events',
        'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.notes',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.payments',
        'app.invoices_payments',
        'app.event_types',
        'app.reservations',
        'app.reservation_statuses',
    ];

    /**
     * Setup Function
     */
    public function setUp()
    {
        parent::setUp();
        $this->useCommandRunner();
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testDescriptionOutput()
    {
        $this->exec('schedule --help');
        $this->assertOutputContains('Schedule Effector Job.');
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testUpdateModified()
    {
        $now = new FrozenTime('2019-01-01 18:00:00');
        FrozenTime::setTestNow($now);

        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $this->Events->EventStatuses->installBaseStatuses();

        $event = $this->Events->get(2);

        $event->set('opening_date', '2019-01-05 18:00:00');
        $event->set('closing_date', '2019-01-10 18:00:00');
        $event->set('start_date', '2019-01-15 18:00:00');
        $event->set('end_date', '2019-01-20 18:00:00');

        $this->Events->save($event, ['validate' => false]);

        $this->exec('schedule -a');
        $this->assertExitCode(Command::CODE_SUCCESS);

        $this->assertOutputContains('Changes:');

        $this->assertSame($event->modified->timestamp, $now->timestamp);
        $this->assertOutputContains($event->name);
    }
}
