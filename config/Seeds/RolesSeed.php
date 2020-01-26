<?php

use Migrations\AbstractSeed;

/**
 * Roles seed.
 */
class RolesSeed extends AbstractSeed
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
                'id' => '1',
                'role' => 'Cub Scout',
                'invested' => '1',
                'minor' => '1',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'Cub',
            ],
            [
                'id' => '2',
                'role' => 'CSL - Cub Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'CSL',
            ],
            [
                'id' => '3',
                'role' => 'ACSL - Assistant Cub Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'ACSL',
            ],
            [
                'id' => '4',
                'role' => 'Parent',
                'invested' => '0',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'Parent',
            ],
            [
                'id' => '5',
                'role' => 'DCSL - District Cub Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'DCSL',
            ],
            [
                'id' => '6',
                'role' => 'ADC - Assistant District Commissioner',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'ADC',
            ],
            [
                'id' => '7',
                'role' => 'DC - District Commissioner',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'DC',
            ],
            [
                'id' => '8',
                'role' => 'YL - Young Leader',
                'invested' => '1',
                'minor' => '1',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'Yl',
            ],
            [
                'id' => '9',
                'role' => 'Scout',
                'invested' => '1',
                'minor' => '1',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'Scout',
            ],
            [
                'id' => '10',
                'role' => 'Beaver',
                'invested' => '1',
                'minor' => '1',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'Beaver',
            ],
            [
                'id' => '11',
                'role' => 'Network Member',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'Network',
            ],
            [
                'id' => '12',
                'role' => 'GSL - Group Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'GSL',
            ],
            [
                'id' => '13',
                'role' => 'ACC - Assistant County Commissioner',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'ACC',
            ],
            [
                'id' => '14',
                'role' => 'BSL - Beaver Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'BSL',
            ],
            [
                'id' => '15',
                'role' => 'ABSL - Assistant Beaver Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'ABSL',
            ],
            [
                'id' => '16',
                'role' => 'Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'SL',
            ],
            [
                'id' => '17',
                'role' => 'Explorer Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'ESL',
            ],
            [
                'id' => '18',
                'role' => 'ASU - Active Support Member',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'ASU',
            ],
            [
                'id' => '19',
                'role' => 'Leader - OSM Generated',
                'invested' => '1',
                'minor' => '0',
                'automated' => '1',
                'deleted' => null,
                'short_role' => 'Generic Leader',
            ],
            [
                'id' => '20',
                'role' => 'ASL - Assistant Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'ASL',
            ],
            [
                'id' => '21',
                'role' => 'AESL - Assistant Explorer Scout Leader',
                'invested' => '1',
                'minor' => '0',
                'automated' => '0',
                'deleted' => null,
                'short_role' => 'AESL',
            ],
        ];

        $table = $this->table('roles');
        $table->insert($data)->save();
    }
}
