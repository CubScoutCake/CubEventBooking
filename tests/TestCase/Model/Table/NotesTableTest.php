<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\NotesTable Test Case
 */
class NotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NotesTable
     */
    public $Notes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notes',
        'app.applications',
        'app.application_statuses',
        'app.users',
        'app.roles',
        'app.sections',
        'app.password_states',
        'app.section_types',
        'app.auth_roles',
        'app.attendees',
        'app.scoutgroups',
        'app.districts',
        'app.notifications',
        'app.notification_types',
        'app.invoices',
        'app.events',
        'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.event_types',
        'app.reservations',
        'app.reservation_statuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Notes') ? [] : ['className' => 'App\Model\Table\NotesTable'];
        $this->Notes = TableRegistry::get('Notes', $config);

        $now = new FrozenTime('2016-12-26 23:22:30');
        FrozenTime::setTestNow($now);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Notes->find('all');

        $timeNow = FrozenTime::now();

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'application_id' => 1,
                'invoice_id' => 1,
                'user_id' => 1,
                'visible' => true,
                'note_text' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'created' => $timeNow,
                'modified' => $timeNow,
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $timeNow = FrozenTime::now();

        $badData = [
            'id' => 'go jump now',
            'application_id' => 1,
            'invoice_id' => 1,
            'user_id' => 1,
            'visible' => 'This is bad',
            'note_text' => 'Lorem ipsum dolor sit amet',
            'deleted' => $timeNow,
            'created' => $timeNow,
            'modified' => $timeNow,
        ];

        $goodData = [
            'id' => 2,
            'application_id' => 1,
            'invoice_id' => 1,
            'user_id' => 1,
            'visible' => true,
            'note_text' => 'Lorem ipsum dolor sit amet',
            'deleted' => null,
            'created' => $timeNow,
            'modified' => $timeNow,
        ];

        $expected = [
            [
                'id' => 1,
                'application_id' => 1,
                'invoice_id' => 1,
                'user_id' => 1,
                'visible' => true,
                'note_text' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'created' => $timeNow,
                'modified' => $timeNow,
            ],
            [
                'id' => 2,
                'application_id' => 1,
                'invoice_id' => 1,
                'user_id' => 1,
                'visible' => true,
                'note_text' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'created' => $timeNow,
                'modified' => $timeNow,
            ],
        ];

        $badEntity = $this->Notes->newEntity($badData);
        $goodEntity = $this->Notes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Notes->save($badEntity));
        $this->Notes->save($goodEntity);

        $query = $this->Notes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $timeNow = FrozenTime::now();

        $badData = [
            'id' => 'go jump now',
            'application_id' => 2,
            'invoice_id' => 2,
            'user_id' => 1,
            'visible' => 'This is bad',
            'note_text' => 'Lorem ipsum dolor sit amet',
            'deleted' => $timeNow,
            'created' => $timeNow,
            'modified' => $timeNow,
        ];

        $outData = [
            'id' => 'go jump now',
            'application_id' => 255,
            'invoice_id' => 991,
            'user_id' => 2421,
            'visible' => 'This is bad',
            'note_text' => 'Lorem ipsum dolor sit amet',
            'deleted' => $timeNow,
            'created' => $timeNow,
            'modified' => $timeNow,
        ];

        $goodData = [
            'id' => 2,
            'application_id' => 1,
            'invoice_id' => 1,
            'user_id' => 1,
            'visible' => true,
            'note_text' => 'Lorem ipsum dolor sit amet',
            'deleted' => null,
            'created' => $timeNow,
            'modified' => $timeNow,
        ];

        $expected = [
            [
                'id' => 1,
                'application_id' => 1,
                'invoice_id' => 1,
                'user_id' => 1,
                'visible' => true,
                'note_text' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'created' => $timeNow,
                'modified' => $timeNow,
            ],
            [
                'id' => 2,
                'application_id' => 1,
                'invoice_id' => 1,
                'user_id' => 1,
                'visible' => true,
                'note_text' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'created' => $timeNow,
                'modified' => $timeNow,
            ],
        ];

        $badEntity = $this->Notes->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $outEntity = $this->Notes->newEntity($outData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Notes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Notes->save($badEntity));
        $this->assertFalse($this->Notes->save($outEntity));
        $this->Notes->save($goodEntity);

        $query = $this->Notes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
