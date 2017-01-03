<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 11/12/2016
 * Time: 19:04
 */
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Migrations\Migrations;

class DatabaseShell extends Shell
{
    public function build()
    {
        $migrations = new Migrations();

        $migrate = $migrations->migrate();
        if (!$migrate) {
            $this->out('Database Migration Implementation Failed.');

            return;
        }
        $this->out('Database Migration Implementation Succeeded.');
    }

    public function seed()
    {
        $migrations = new Migrations();

        $seeded = $migrations->seed(['seed' => 'UsersSeed']);
        if (!$seeded) {
            $this->out('Users Seeding Failed.');

            return;
        }
        $this->out('Users Seeding Succeeded.');

        $seeded = $migrations->seed(['seed' => 'SettingsSeed']);
        if (!$seeded) {
            $this->out('Settings Seeding Failed.');

            return;
        }
        $this->out('Settings Seeding Succeeded.');
    }

    public function password()
    {
        $users = TableRegistry::get('Users');

        $default = $users->findByUsername('Jacob')->first();
        $default->password = 'TestMe';

        if (!$users->save($default)) {
            $this->out('User Password Reset Failed.');

            return;
        }
        $this->out('User Password Reset Succeeded.');
    }
}
