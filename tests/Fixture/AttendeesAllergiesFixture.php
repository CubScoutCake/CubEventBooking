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
        'attendee_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'allergy_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'attendees_allergies_attendee_id_allergy_id' => ['type' => 'index', 'columns' => ['attendee_id', 'allergy_id'], 'length' => []],
            'attendees_allergies_attendee_id' => ['type' => 'index', 'columns' => ['attendee_id'], 'length' => []],
            'atal_alle_x_atts_idx' => ['type' => 'index', 'columns' => ['attendee_id', 'allergy_id'], 'length' => []],
            'attendees_allergies_allergy_id' => ['type' => 'index', 'columns' => ['allergy_id'], 'length' => []],
        ],
        '_constraints' => [
            'attendees_allergies_allergy_id' => ['type' => 'foreign', 'columns' => ['allergy_id'], 'references' => ['allergies', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'attendees_allergies_attendee_id' => ['type' => 'foreign', 'columns' => ['attendee_id'], 'references' => ['attendees', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
