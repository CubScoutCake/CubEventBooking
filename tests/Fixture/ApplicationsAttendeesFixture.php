<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsAttendeesFixture
 */
class ApplicationsAttendeesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'application_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'attendee_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'applications_attendees_application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
            'applications_attendees_attendee_id_application_id' => ['type' => 'index', 'columns' => ['application_id', 'attendee_id'], 'length' => []],
            'applications_attendees_attendee_id' => ['type' => 'index', 'columns' => ['attendee_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['application_id', 'attendee_id'], 'length' => []],
            'applications_attendees_application_id' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['applications', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'applications_attendees_attendee_id' => ['type' => 'foreign', 'columns' => ['attendee_id'], 'references' => ['attendees', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'application_id' => 1,
                'attendee_id' => 2
            ],
            [
                'application_id' => 1,
                'attendee_id' => 3
            ],
            [
                'application_id' => 1,
                'attendee_id' => 4
            ],
            [
                'application_id' => 1,
                'attendee_id' => 5
            ],
            [
                'application_id' => 1,
                'attendee_id' => 6
            ],
            [
                'application_id' => 1,
                'attendee_id' => 7
            ],
            [
                'application_id' => 1,
                'attendee_id' => 8
            ],
            [
                'application_id' => 1,
                'attendee_id' => 9
            ],
            [
                'application_id' => 1,
                'attendee_id' => 11
            ],
            [
                'application_id' => 1,
                'attendee_id' => 12
            ],
            [
                'application_id' => 3,
                'attendee_id' => 1
            ],
            [
                'application_id' => 3,
                'attendee_id' => 2
            ],
            [
                'application_id' => 3,
                'attendee_id' => 3
            ],
            [
                'application_id' => 3,
                'attendee_id' => 4
            ],
            [
                'application_id' => 3,
                'attendee_id' => 5
            ],
            [
                'application_id' => 3,
                'attendee_id' => 6
            ],
            [
                'application_id' => 3,
                'attendee_id' => 7
            ],
            [
                'application_id' => 3,
                'attendee_id' => 8
            ],
            [
                'application_id' => 3,
                'attendee_id' => 9
            ],
            [
                'application_id' => 3,
                'attendee_id' => 10
            ],
            [
                'application_id' => 3,
                'attendee_id' => 11
            ],
            [
                'application_id' => 3,
                'attendee_id' => 12
            ],
        ];
        parent::init();
    }
}
