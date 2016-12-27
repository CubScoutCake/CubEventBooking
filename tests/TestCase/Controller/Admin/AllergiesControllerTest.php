<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\AllergiesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\AllergiesController Test Case
 */
class AllergiesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.allergies',
        'app.attendees',
        'app.roles',
        'app.districts',
        'app.scoutgroups',
        'app.users',
        'app.attendees_allergies'
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/allergies');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/allergies');

        $this->assertResponseOk();
    }

    public function testIndexQueryData()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/allergies?page=1');

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/allergies/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testView()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/allergies/view/1');

        $this->assertResponseOk();
    }

    public function testAddUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/allergies/add');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testAdd()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/allergies/add');

        $this->assertResponseOk();
    }

    public function testAddPostBadCsrf()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->enableSecurityToken();

        $data = [
            'id' => 2,
            'allergy' => 'Test Me',
            'description' => 'This is a test Allergy'
        ];
        $this->post('/allergies/add', $data);

        $this->assertResponseError();
    }

    public function testAddPostGoodData()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.authrole' => 'admin'
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 5,
            'allergy' => 'I am a Test',
            'description' => 'This is a different test Allergy'
        ];
        $this->post('/allergies/admin/add', $data);

        $this->markTestSkipped('Allergy Error Needs fixing. TODO');

        $this->assertRedirect(['controller' => 'allergies', 'action' => 'index']);

        $articles = TableRegistry::get('Allergies');
        $query = $articles->find()->where(['allergy' => $data['allergy']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddPostBadData()
    {
        $this->session(['Auth.User.id' => 1]);

        $data = [
            'id' => '4',
            'allergy' => null,
            'description' => null
        ];
        $this->post('/allergies', $data);

        $this->assertResponseError();
    }
}
