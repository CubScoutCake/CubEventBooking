<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\SuperUser;

use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 *
 * @property \App\Model\Table\ScoutgroupsTable $Scoutgroups
 * @property \App\Model\Table\UsersTable $Users
 */
class LandingController extends AppController
{

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['link']
        ]);
    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function superUserHome()
    {
        // Get Entities from Registry
        $apps = TableRegistry::getTableLocator()->get('Applications');
        $evs = TableRegistry::getTableLocator()->get('Events');
        $invs = TableRegistry::getTableLocator()->get('Invoices');
        $usrs = TableRegistry::getTableLocator()->get('Users');
        $pays = TableRegistry::getTableLocator()->get('Payments');
        $atts = TableRegistry::getTableLocator()->get('Attendees');
        $nts = TableRegistry::getTableLocator()->get('Notes');
        $notifs = TableRegistry::getTableLocator()->get('Notifications');

        $userId = $this->Auth->user('id');

        // Table Entities
        $applications = $apps->find()->contain(['Users', 'Sections.Scoutgroups'])->order(['Applications.modified' => 'DESC'])->limit(10);
        $events = $evs->find('upcoming')->contain(['Settings'])->order(['Events.start_date' => 'ASC']);
        $invoices = $invs->find()->contain(['Users', 'Applications'])->order(['Invoices.modified' => 'DESC'])->limit(10);
        $users = $usrs->find()->contain(['Roles', 'Sections.SectionTypes', 'AuthRoles'])->order(['Users.last_login' => 'DESC'])->limit(10);
        $payments = $pays->find()->contain(['Invoices'])->order(['Payments.created' => 'DESC'])->limit(10);
        $notes = $nts->find()->contain(['Invoices', 'Applications', 'Users'])->order(['Notes.modified' => 'DESC'])->limit(10);
        $notifications = $notifs->find()->contain(['NotificationTypes', 'Users'])->order(['Notifications.created' => 'DESC'])->limit(10);

        // Pass to View
        $this->set(compact('applications', 'events', 'invoices', 'users', 'payments', 'notes', 'notifications'));

        // Counts of Entities
        $cntApplications = $apps->find('all')->count();
        $cntEvents = $evs->find('all')->count();
        $cntInvoices = $invs->find('all')->count();
        $cntUsers = $usrs->find('all')->count();
        $cntPayments = $pays->find('all')->count();
        $cntAttendees = $atts->find('all')->count();

        // Pass to View
        $this->set(compact('cntApplications', 'cntEvents', 'cntInvoices', 'cntUsers', 'cntPayments', 'cntAttendees', 'userId'));
    }

    /**
     * @param null $linkEntry The Search Text
     *
     * @return \Cake\Http\Response|null
     */
    public function link($linkEntry = null)
    {
        $searchEntry = $this->request->getQuery('q');

        if (!is_null($linkEntry)) {
            $searchEntry = $linkEntry;
        }

        $this->set(compact('searchEntry'));

        $idNum = null;

        if (isset($searchEntry) || !is_null($searchEntry)) {
            $entStr = strtoupper($searchEntry);

            $cont = substr($entStr, 0, 1);

            $objectId = substr($entStr, 1);
            $idNum = intval($objectId);

            if (is_int($idNum) && $idNum != 0) {
                switch ($cont) {
                    case "U":
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view', $idNum]);
                    case "I":
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'view', $idNum]);
                    case "A":
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'view', $idNum]);
                    case "N":
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'view', $idNum]);
                    case "P":
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Payments', 'action' => 'view', $idNum]);
                    case "T":
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Attendees', 'action' => 'view', $idNum]);
                    case "E":
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Events', 'action' => 'view', $idNum]);
                    case "S":
                        return $this->redirect(['controller' => 'Settings', 'action' => 'view', $idNum]);
                    default:
                        return $this->redirect(['action' => 'admin_home']);
                }
            }
        }

        if (!is_int($idNum) || $idNum == 0 || is_null($idNum)) {
            $this->Users = TableRegistry::getTableLocator()->get('Users');

            $userQuery = $this->Users
                ->find('search', ['search' => $this->request->getQueryParams()])
                ->contain(['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes', 'AuthRoles']);

            $this->set('users', $this->paginate($userQuery));

            $this->paginate = [
                'contain' => ['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes'],
                'order' => ['last_login' => 'DESC'],
                'limit' => 10
            ];

            $this->Scoutgroups = TableRegistry::getTableLocator()->get('Scoutgroups');

            $sections = $this->Users->Sections
                ->find(
                    'list',
                    [
                        'keyField' => 'id',
                        'valueField' => 'section',
                        'groupField' => 'scoutgroup.district.district'
                    ]
                )
                ->contain(['Scoutgroups.Districts']);
            $roles = $this->Users->Roles->find('leaders')->find('list');
            $authRoles = $this->Users->AuthRoles->find('list');
            $districts = $this->Scoutgroups->Districts->find('list');
            $this->set(compact('sections', 'roles', 'authRoles', 'districts'));

            $groupQuery = $this->Scoutgroups
                // Use the plugins 'search' custom finder and pass in the
                // processed query params
                ->find('search', ['search' => $this->request->getQueryParams()])
                // You can add extra things to the query if you need to
                ->contain(['Districts'])
                ->orderDesc('district_id', 'number_stripped')
                ->limit(10);

            $this->set('scoutgroups', $groupQuery->toArray());
        }
    }
}
