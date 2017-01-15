<?php
use Migrations\AbstractSeed;

/**
 * SettingTypes seed.
 */
class SettingTypesSeed extends AbstractSeed
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
                'setting_type' => 'General',
                'description' => 'General Setting Type',
            ],
            [
                'id' => '2',
                'setting_type' => 'Code',
                'description' => 'SQL or PHP code for insertion.',
            ],
            [
                'id' => '3',
                'setting_type' => 'Legal Text',
                'description' => 'Specifying Legal Text for Use under areas.',
            ],
            [
                'id' => '4',
                'setting_type' => 'Invoice Label',
                'description' => 'Labels for invoices - e.g. INV#',
            ],
            [
                'id' => '5',
                'setting_type' => 'Image Size',
                'description' => 'An image height in px for a template.',
            ],
        ];

        $table = $this->table('setting_types');
        $table->insert($data)->save();
    }
}
