<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\SyncBookForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\SyncBookForm Test Case
 */
class SyncBookFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\SyncBookForm
     */
    public $SyncBook;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->SyncBook = new SyncBookForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SyncBook);

        parent::tearDown();
    }

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
