<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 11/12/2016
 * Time: 19:04
 */
namespace App\Shell;

use Cake\Console\Shell;
use Migrations\Migrations;

class DatabaseShell extends Shell
{
    public function build()
    {
        $migrations = new Migrations();

        $migrate = $migrations->migrate();
        if(!$migrate) {
            $this->out('Database Migration Implementation Failed.');
            return;
        }
        $this->out('Database Migration Implementation Succeeded.');

        $seeded = $migrations->seed(['seed' => 'UsersSeed']);
        if(!$seeded){
            $this->out('Users Seeding Failed.');
            return;
        }
        $this->out('Users Seeding Succeeded.');

        $seeded = $migrations->seed(['seed' => 'SettingsSeed']);
        if(!$seeded){
            $this->out('Settings Seeding Failed.');
            return;
        }
        $this->out('Settings Seeding Succeeded.');
    }
}