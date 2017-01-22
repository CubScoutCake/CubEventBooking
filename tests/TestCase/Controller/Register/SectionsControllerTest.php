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
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.roles'
    ];

    /**
     * Test view method
     *
     * @return void
     */
    public function testSelect()
    {
        $this->get('/register/sections/select');

        $this->assertResponseOk();

        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/register/sections/select');

        $this->assertResponseOk();

        $groups = $this->viewVariable('scoutgroups');
        $types = $this->viewVariable('sectionTypes');

        $this->assertTrue(isset($groups));
        $this->assertTrue(isset($types));
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testExisting()
    {
        $this->get('/register/sections/existing/1/1');

        $this->assertResponseOk();

        $this->get('/register/sections/existing/1');

        $this->assertRedirect();

        $this->get('/register/sections/existing/');

        $this->assertRedirect();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->get('/register/sections/add/1/1');

        $this->assertResponseOk();

        $this->get('/register/sections/add/1');

        $this->assertRedirect();

        $this->get('/register/sections/add/');

        $this->assertRedirect();
    }
}
