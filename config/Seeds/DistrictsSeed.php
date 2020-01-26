<?php

use Migrations\AbstractSeed;

/**
 * Districts seed.
 */
class DistrictsSeed extends AbstractSeed
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
                'district' => 'Letchworth & Baldock',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'L&B',
            ],
            [
                'id' => '2',
                'district' => 'Bishops Stortford And District',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Bishops',
            ],
            [
                'id' => '3',
                'district' => 'East Herts',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'EastHerts',
            ],
            [
                'id' => '4',
                'district' => 'Elstree And District',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Elstree',
            ],
            [
                'id' => '5',
                'district' => 'Harpenden And Wheathampstead',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Harpenden',
            ],
            [
                'id' => '6',
                'district' => 'Hemel Hempstead',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Hemel',
            ],
            [
                'id' => '7',
                'district' => 'Hertford',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Hertford',
            ],
            [
                'id' => '8',
                'district' => 'Hitchin And District',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Hitchin',
            ],
            [
                'id' => '9',
                'district' => 'Mid Herts',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'MidHerts',
            ],
            [
                'id' => '10',
                'district' => 'Potters Bar And District',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'PottersBar',
            ],
            [
                'id' => '11',
                'district' => 'Rickmansworth And Chorleywood',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Ricky&C\'wood',
            ],
            [
                'id' => '12',
                'district' => 'Royston',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Royston',
            ],
            [
                'id' => '13',
                'district' => 'St Albans',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'St Albans',
            ],
            [
                'id' => '14',
                'district' => 'Stevenage',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Stevenage',
            ],
            [
                'id' => '15',
                'district' => 'Ware And District',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Ware',
            ],
            [
                'id' => '16',
                'district' => 'Watford North',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Watford (N)',
            ],
            [
                'id' => '17',
                'district' => 'Watford South',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'Watford (S)',
            ],
            [
                'id' => '18',
                'district' => 'West Herts',
                'county' => 'Hertfordshire',
                'deleted' => null,
                'short_name' => 'WestHerts',
            ],
        ];

        $table = $this->table('districts');
        $table->insert($data)->save();
    }
}
