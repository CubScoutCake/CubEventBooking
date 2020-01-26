<?php

use Migrations\AbstractSeed;

/**
 * SectionTypes seed.
 */
class SectionTypesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'section_type' => 'Cubs',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 1,
            ],
            [
                'section_type' => 'Beavers',
                'upper_age' => 8,
                'lower_age' => 6,
                'role_id' => 10,
            ],
            [
                'section_type' => 'Scouts',
                'upper_age' => 14,
                'lower_age' => 10,
                'role_id' => 9,
            ],
            [
                'section_type' => 'Adults',
                'upper_age' => 99,
                'lower_age' => 18,
                'role_id' => 19,
            ],
        ];

        $table = $this->table('section_types');
        $table->insert($data)->save();
    }
}
