<?php
declare(strict_types=1);

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

namespace App\Controller\Admin;

use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class LandingController extends AppController
{
    /**
     * User Home Redirect Function
     *
     * @return \Cake\Http\Response|null
     */
    public function userHome()
    {
        return $this->redirect([
            'controller' => 'Landing',
            'action' => 'user_home',
            'prefix' => false,
        ]);
    }

    /**
     * Setup Config
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['link'],
        ]);
    }

    /**
     * Displays a view
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function adminHome()
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

        $user = $usrs->get($userId, ['contain' => ['Sections', 'AuthRoles']]);
        $authArray = [
            'section_type_id' => $user->section->section_type_id,
            'section_limited' => $user->auth_role->section_limited,
        ];

        // Limited Table Entities
        $applications = $apps->find('sameSection', $authArray)->contain([
            'Users',
            'Sections.Scoutgroups.Districts',
        ])->order(['Applications.modified' => 'DESC'])->limit(10);
        $events = $evs->find('upcoming')->find(
            'sameSection',
            $authArray
        )->contain(['EventStatuses'])->order(['Events.start_date' => 'ASC']);
        $invoices = $invs->find('sameSection', $authArray)->contain([
            'Users',
            'Applications',
            'Reservations',
        ])->order(['Invoices.modified' => 'DESC'])->limit(10);
        $users = $usrs->find('sameSection', $authArray)->find('access')->contain([
            'Roles',
            'Sections.Scoutgroups.Districts',
            'AuthRoles',
        ])->order(['Users.last_login' => 'DESC'])->limit(10);
        $payments = $pays->find(
            'sameSection',
            $authArray
        )->contain(['Invoices'])->order(['Payments.created' => 'DESC'])->limit(10);
        $notes = $nts->find('sameSection', $authArray)->contain([
            'Invoices',
            'Applications',
            'Users',
        ])->order(['Notes.modified' => 'DESC'])->limit(10);
        $notifications = $notifs->find('sameSection', $authArray)->contain([
            'NotificationTypes',
            'Users',
        ])->order(['Notifications.created' => 'DESC'])->limit(10);

        // Pass to View
        $this->set(compact('applications', 'events', 'invoices', 'users', 'payments', 'notes', 'notifications'));

        // Counts of Entities
        $cntApplications = $apps->find('sameSection', $authArray)->count();
        $cntEvents = $evs->find('sameSection', $authArray)->find('all')->count();
        $cntInvoices = $invs->find('sameSection', $authArray)->count();
        $cntUsers = $usrs->find('sameSection', $authArray)->count();
        $cntPayments = $pays->find('sameSection', $authArray)->count();
        $cntAttendees = $atts->find('sameSection', $authArray)->count();

        // Pass to View
        $this->set(compact(
            'cntApplications',
            'cntEvents',
            'cntInvoices',
            'cntUsers',
            'cntPayments',
            'cntAttendees',
            'userId'
        ));
    }

    /**
     * @param int $linkEntry Search Parameter
     *
     * @return \Cake\Http\Response|null
     */
    public function link($linkEntry = null)
    {
        $searchEntry = $this->request->getQuery('q');

        if (! is_null($linkEntry)) {
            $searchEntry = $linkEntry;
        }

        $this->set(compact('searchEntry'));

        $idNum = null;

        if (isset($searchEntry) || ! is_null($searchEntry)) {
            $entStr = strtoupper($searchEntry);

            $cont = substr($entStr, 0, 1);

            $id = substr($entStr, 1);
            $idNum = intval($id);

            if (is_int($idNum) && $idNum != 0) {
                switch ($cont) {
                    case "U":
                        return $this->redirect(['controller' => 'Users', 'action' => 'view', $idNum]);
                    case "I":
                        return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $idNum]);
                    case "A":
                        return $this->redirect(['controller' => 'Applications', 'action' => 'view', $idNum]);
                    case "N":
                        return $this->redirect(['controller' => 'Notes', 'action' => 'view', $idNum]);
                    case "P":
                        return $this->redirect(['controller' => 'Payments', 'action' => 'view', $idNum]);
                    case "T":
                        return $this->redirect(['controller' => 'Attendees', 'action' => 'view', $idNum]);
                    case "E":
                        return $this->redirect(['controller' => 'Events', 'action' => 'view', $idNum]);
                    case "S":
                        return $this->redirect(['controller' => 'Settings', 'action' => 'view', $idNum]);
                    case "R":
                        return $this->redirect(['controller' => 'Reservations', 'action' => 'view', $idNum]);
                    default:
                        return $this->redirect(['action' => 'admin_home']);
                }
            }
        }

        if (! is_int($idNum) || $idNum == 0 || is_null($idNum)) {
            $this->Sections = TableRegistry::getTableLocator()->get('Sections');
            $this->Users = TableRegistry::getTableLocator()->get('Users');
            $section = $this->Sections->get($this->Auth->user('section_id'));

            $userQuery = $this->Users
                ->find('search', ['search' => $this->request->getQueryParams()])
                ->contain(['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes', 'AuthRoles'])
                ->where(['SectionTypes.id' => $section['section_type_id']]);

            $this->set('users', $this->paginate($userQuery));

            $this->paginate = [
                'contain' => ['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes'],
                'order' => ['last_login' => 'DESC'],
                'limit' => 10,
                'conditions' => ['SectionTypes.id' => $section['section_type_id']],
            ];

            $this->Scoutgroups = TableRegistry::getTableLocator()->get('Scoutgroups');

            $sections = $this->Users->Sections
                ->find(
                    'list',
                    [
                        'keyField' => 'id',
                        'valueField' => 'section',
                        'groupField' => 'scoutgroup.district.district',
                    ]
                )
                ->where(['section_type_id' => $section['section_type_id']])
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
