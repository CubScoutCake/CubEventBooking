<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AllergiesFixture
 *
 */
class AllergiesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'allergy' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'is_medical' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'is_specific' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'is_dietary' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
                'allergy' => 'Fish Allergy',
                'description' => 'Fish Allergies can kill cuttlefish',
                'is_medical' => false,
                'is_specific' => false,
                'is_dietary' => true
            ],
            [
                'allergy' => 'Goats',
                'description' => 'Goat Allergy is very serious',
                'is_medical' => false,
                'is_specific' => false,
                'is_dietary' => true
            ],
            [
                'allergy' => 'Diabetes',
                'description' => 'Crazy sugar thing',
                'is_medical' => true,
                'is_specific' => false,
                'is_dietary' => true
            ],
            [
                'allergy' => 'Epilepsy',
                'description' => 'Serious Neural disorder',
                'is_medical' => false,
                'is_specific' => false,
                'is_dietary' => true
            ],
            [
                'allergy' => 'Cream',
                'description' => 'Jacob is very dangerously allergic to cream',
                'is_medical' => false,
                'is_specific' => true,
                'is_dietary' => true
            ],
        ];
        parent::init();
    }
}
