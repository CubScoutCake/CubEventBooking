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
                'setting_type' => 'General',
                'description' => 'General Setting Type',
            ],
            [
                'setting_type' => 'Code',
                'description' => 'SQL or PHP code for insertion.',
            ],
            [
                'setting_type' => 'Legal Text',
                'description' => 'Specifying Legal Text for Use under areas.',
            ],
            [
                'setting_type' => 'Invoice Label',
                'description' => 'Labels for invoices - e.g. INV#',
            ],
            [
                'setting_type' => 'Image Size',
                'description' => 'An image height in px for a template.',
            ],
            [
                'setting_type' => 'Application Term',
                'description' => 'A term for an application. E.g. Team.',
            ],
        ];

        $table = $this->table('setting_types');
        $table->insert($data)->save();
    }
}
