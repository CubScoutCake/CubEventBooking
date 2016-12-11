<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttendeesAllergiesFixture
 *
 */
class AttendeesAllergiesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'attendee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'allergy_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'allergy_idx' => ['type' => 'index', 'columns' => ['attendee_id', 'allergy_id'], 'length' => []],
            'allergy_key' => ['type' => 'index', 'columns' => ['allergy_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['attendee_id', 'allergy_id'], 'length' => []],
            'allergies_key' => ['type' => 'foreign', 'columns' => ['allergy_id'], 'references' => ['allergies', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'attendees_key' => ['type' => 'foreign', 'columns' => ['attendee_id'], 'references' => ['attendees', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
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
            'attendee_id' => 1,
            'allergy_id' => 1
        ],
    ];
}
