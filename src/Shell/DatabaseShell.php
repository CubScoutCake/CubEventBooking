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
use Cake\ORM\TableRegistry;

class DatabaseShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
    }

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
        if(!$seeded) {
            $this->out('Users Seeding Failed.');
            return;
        }
        $this->out('Users Seeding Succeeded.');

        $seeded = $migrations->seed(['seed' => 'SettingsSeed']);
        if(!$seeded) {
            $this->out('Settings Seeding Failed.');
            return;
        }
        $this->out('Settings Seeding Succeeded.');
    }

    public function password()
    {
        $default = $this->Users->findByUsername('Jacob')->first();
        $default->password = 'TestMe';

        if(!$this->Users->save($default)) {
            $this->out('User Password Reset Failed.');
            return;
        }
        $this->out('User Password Reset Succeeded.');
    }
}