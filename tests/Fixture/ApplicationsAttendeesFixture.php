<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsAttendeesFixture
 *
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
        'application_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'attendee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'attendee_idx' => ['type' => 'index', 'columns' => ['attendee_id', 'application_id'], 'length' => []],
        ],
        '_constraints' => [
            'application_key' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['applications', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'attendee_key' => ['type' => 'foreign', 'columns' => ['attendee_id'], 'references' => ['attendees', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
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
            'attendee_id' => 10
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
}
