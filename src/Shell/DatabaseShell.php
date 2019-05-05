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

/**
 * Class DatabaseShell
 *
 * @package App\Shell
 *
 * @property \App\Model\Table\EventStatusesTable $EventStatuses
 * @property \App\Model\Table\ApplicationStatusesTable $ApplicationStatuses
 */
class DatabaseShell extends Shell
{
    /**
     * Function to build the database via migrations.
     *
     * @return void
     */
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

    /**
     * Function to add basic config data to the database.
     *
     * @return void
     */
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

    /**
     * Hashes the password for the inital user with the installed Hash.
     *
     * @return void
     */
    public function password()
    {
        $users = TableRegistry::getTableLocator()->get('Users');

        $default = $users->findByUsername('Jacob')->first();
        $default->password = 'TestMe';

        if (!$users->save($default)) {
            $this->out('User Password Reset Failed.');

            return;
        }
        $this->out('User Password Reset Succeeded.');
    }

    /**
     * Installs standard Values
     *
     * @return void
     */
    public function base()
    {
        $this->EventStatuses = TableRegistry::getTableLocator()->get('EventStatuses');
        $statuses = $this->EventStatuses->installBaseStatuses();
        $this->out($statuses . ' Event Statuses Installed.');

        $this->ApplicationStatuses = TableRegistry::getTableLocator()->get('ApplicationStatuses');
        $statuses = $this->ApplicationStatuses->installBaseStatuses();
        $this->out($statuses . ' Application Statuses Installed.');
    }
}
