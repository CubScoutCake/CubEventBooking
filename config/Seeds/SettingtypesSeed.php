<?php
use Migrations\AbstractSeed;

/**
 * Settingtypes seed.
 */
class SettingtypesSeed extends AbstractSeed
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
                'settingtype' => 'General',
                'description' => 'General Setting Type',
            ],
            [
                'id' => '2',
                'settingtype' => 'Code',
                'description' => 'SQL or PHP code for insertion.',
            ],
            [
                'id' => '3',
                'settingtype' => 'Legal Text',
                'description' => 'Specifying Legal Text for Use under areas.',
            ],
            [
                'id' => '4',
                'settingtype' => 'Invoice Label',
                'description' => 'Labels for invoices - e.g. INV#',
            ],
            [
                'id' => '5',
                'settingtype' => 'Image Size',
                'description' => 'An image height in px for a template.',
            ],
        ];

        $table = $this->table('settingtypes');
        $table->insert($data)->save();
    }
}
