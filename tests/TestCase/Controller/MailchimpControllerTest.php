<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\ChampionsController Test Case
 */
class MailchimpControllerTest extends IntegrationTestCase
{
    /**
     * Test Mailchimp method
     *
     * @return void
     */
    public function testMailchimp()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2,
        ]);

        $this->get('/mailchimp/mailchimp');

        $this->assertResponseOk();
    }

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->get('/mailchimp/mailchimp');

        $this->assertResponseOk();
    }
}
