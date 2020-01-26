<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\SuperUser;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NotificationtypesController Test Case
 */
class NotificationtypesControllerTest extends IntegrationTestCase
{
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
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
