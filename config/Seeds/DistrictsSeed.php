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
                'deleted' => NULL,
            ],
            [
                'id' => '2',
                'district' => 'Bishops Stortford And District',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '3',
                'district' => 'East Herts',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '4',
                'district' => 'Elstree And District',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '5',
                'district' => 'Harpenden And Wheathampstead',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '6',
                'district' => 'Hemel Hempstead',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '7',
                'district' => 'Hertford',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '8',
                'district' => 'Hitchin And District',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '9',
                'district' => 'Mid Herts',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '10',
                'district' => 'Potters Bar And District',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '11',
                'district' => 'Rickmansworth And Chorleywood',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '12',
                'district' => 'Royston',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '13',
                'district' => 'St Albans',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '14',
                'district' => 'Stevenage',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '15',
                'district' => 'Ware And District',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '16',
                'district' => 'Watford North',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '17',
                'district' => 'Watford South',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
            [
                'id' => '18',
                'district' => 'West Herts',
                'county' => 'Hertfordshire',
                'deleted' => NULL,
            ],
        ];

        $table = $this->table('districts');
        $table->insert($data)->save();
    }
}
