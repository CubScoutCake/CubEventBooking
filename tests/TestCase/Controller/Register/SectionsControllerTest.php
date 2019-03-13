<?php
namespace App\Test\TestCase\Controller\Register;

use App\Controller\SectionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SectionsController Test Case
 */
class SectionsControllerTest extends IntegrationTestCase
{

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
        'app.setting_types',
        'app.settings',
        'app.users',
    ];

    /**
     * Test view method
     *
     * @return void
     *
     * @throws
     */
    public function testSelect()
    {
        $this->get('/register/sections/select');

        $this->assertResponseOk();

        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'select',
        ]);

        $this->assertResponseOk();

        $groups = $this->viewVariable('scoutgroups');
        $types = $this->viewVariable('sectionTypes');

        $this->assertTrue(isset($groups));
        $this->assertTrue(isset($types));

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        // Test Existing Section Found.

        $this->post([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'select',
        ], [
            'scoutgroup_id' => 1,
            'section_type_id' => 2,
        ]);

        $this->assertRedirect([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'existing',
            1, 2,
        ]);
    }

    /**
     * Test Existing method
     *
     * @return void
     *
     * @throws
     */
    public function testExisting()
    {
        // Assert Missing Variables redirects
        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'existing',
        ]);
        $this->assertRedirect([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'select',
        ]);

        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'existing',
            1
        ]);
        $this->assertRedirect([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'select',
        ]);

        // Assert Existing Section Found
        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'existing',
            1, 1,
        ]);

        $this->assertResponseOk();
        $sectionsFound = $this->viewVariable('existing')->toArray();
        $this->assertEquals([1 => 'Lorem ipsum dolor sit amet'], $sectionsFound);

        // Test New Section Redirect
        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'existing',
            2, 3,
        ]);

        $this->assertRedirect([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'add',
            2, 3,
        ]);

        $this->assertFlashMessageAt(0, 'No existing sections were found. Please create a new one.');
    }

    /**
     * Test add method
     *
     * @return void
     *
     * @throws
     */
    public function testAdd()
    {
        // Assert redirect when variables missing
        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'add',
        ]);
        $this->assertRedirect([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'select',
        ]);

        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'add',
            1
        ]);
        $this->assertRedirect([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'select',
        ]);

        // Assert Add's get method works
        $this->get([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'add',
            1,
            2
        ]);
        $this->assertResponseOk();

        /** @var \App\Model\Entity\Section $section */
        $section = $this->viewVariable('section');

        $groupId = $section->get('scoutgroup_id');
        $typeId = $section->get('section_type_id');
        $suggested = $section->get('section');

        $this->assertEquals(1, $groupId);
        $this->assertEquals(2, $typeId);

        $this->assertSame($suggested, 'Lorem ip - Cubs');

        // Assert Post Functional
        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $sectionData = [ 'section' => 'Cubs - LlamaLand Section' ];

        $this->post([
            'prefix' => 'register',
            'controller' => 'Sections',
            'action' => 'add',
            1,
            2
        ], $sectionData);

        $this->assertRedirect([
            'prefix' => 'register',
            'controller' => 'Users',
            'action' => 'register',
            3
        ]);
        $this->assertFlashMessageAt(0, 'The section has been saved.');

        $sections = $this->getTableLocator()->get('Sections');
        $section = $sections->get(3);

        $this->assertEquals($groupId, $section->scoutgroup_id);
        $this->assertEquals($typeId, $section->section_type_id);
        $this->assertSame($sectionData['section'], $section->section);
    }
}
