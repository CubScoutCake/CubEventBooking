<?php

use Migrations\AbstractSeed;

/**
 * Sections seed.
 */
class SectionsSeed extends AbstractSeed
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
                'id' => 1,
                'created' => '2016-12-27 18:28:03',
                'modified' => '2016-12-27 18:28:03',
                'section' => 'Cub Section',
                'section_type_id' => 1,
                'scoutgroup_id' => 106,
            ],
        ];

        $table = $this->table('sections');
        $table->insert($data)->save();
    }
}
