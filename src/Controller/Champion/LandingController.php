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
namespace App\Controller\Champion;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use App\Controller\Champion\AppController;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class LandingController extends AppController
{

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
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function championHome()
    {
        // Get Entities from Registry
        $this->Applications = TableRegistry::get('Applications');
        $this->Events = TableRegistry::get('Events');
        $this->Invoices = TableRegistry::get('Invoices');
        $this->Users = TableRegistry::get('Users');
        $this->Payments = TableRegistry::get('Payments');
        $this->Districts = TableRegistry::get('Districts');
        $this->Attendees = TableRegistry::get('Attendees');
        $this->Sections = TableRegistry::get('Sections');
        $this->Scoutgroups = TableRegistry::get('Scoutgroups');

        $now = Time::now();
        $userId = $this->Auth->user('id');
        $user = $this->Users->get($userId);
        $section = $this->Sections->get($user->section_id);
        $group = $this->Scoutgroups->get($section->scoutgroup_id);
        $champD = $this->Districts->get($group->district_id);

        // Table Entities
        $applications = $this->Applications->find()->contain(['Users', 'Sections.Scoutgroups'])->where(['Scoutgroups.district_id' => $champD->id])->order(['Applications.modified' => 'DESC'])->limit(15);
        $events = $this->Events->find('upcoming')->contain(['Settings'])->order(['Events.start_date' => 'ASC']);
        $invoices = $this->Invoices->find()->contain(['Users', 'Applications', 'Applications.Sections.Scoutgroups'])->where(['Scoutgroups.district_id' => $champD->id])->order(['Invoices.modified' => 'DESC'])->limit(15);
        $users = $this->Users->find()->contain(['Roles', 'Sections.Scoutgroups'])->where(['Scoutgroups.district_id' => $champD->id])->order(['Users.modified' => 'DESC'])->limit(15);
        $payments = $this->Payments->find()->contain(['Invoices'])->order(['Payments.created' => 'DESC'])->limit(15);

        // Pass to View
        $this->set(compact('applications', 'events', 'invoices', 'users', 'payments'));

        /*// Counts of Entities
        $cntApplications = $this->Applications->find('all')->count('*');
        $cntEvents = $this->Events->find('all')->count('*');
        $cntInvoices = $this->Invoices->find('all')->count('*');
        $cntUsers = $usrs->find('all')->count('*');
        $cntPayments = $this->Payments->find('all')->count('*');

        // Pass to View
        $this->set(compact('cntApplications', 'cntEvents','cntInvoices','cntUsers','cntPayments','userId'));*/

        // Counts of Entities
        $cntApplications = $this->Applications->find('all')->contain(['Sections.Scoutgroups'])->where(['Scoutgroups.district_id' => $champD->district_id])->count('*');
        $cntEvents = $this->Events->find('all')->count('*');
        $cntInvoices = $this->Invoices->find('all')->contain(['Applications.Sections.Scoutgroups'])->where(['Scoutgroups.district_id' => $champD->district_id])->count('*');
        $cntUsers = $this->Users->find('all')->contain(['Sections.Scoutgroups'])->where(['Scoutgroups.district_id' => $champD->district_id])->count('*');
        $cntPayments = $this->Payments->find('all')->count('*');
        $cntAttendees = $this->Attendees->find('all')->contain(['Users.Sections.Scoutgroups'])->where(['Scoutgroups.district_id' => $champD->district_id])->count('*');

        // Pass to View
        $this->set(compact('cntApplications', 'cntEvents', 'cntInvoices', 'cntUsers', 'cntPayments', 'cntAttendees'));
    }

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

            $id = substr($entStr, 1);
            $idNum = intval($id);

            if (is_int($idNum) && $idNum != 0) {
                switch ($cont) {
                    case "U":
                        return $this->redirect(['controller' => 'Users', 'action' => 'view', $idNum]);
                        break;
                    case "I":
                        return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $idNum]);
                        break;
                    case "A":
                        return $this->redirect(['controller' => 'Applications', 'action' => 'view', $idNum]);
                        break;
                    case "N":
                        return $this->redirect(['controller' => 'Notes', 'action' => 'view', $idNum]);
                        break;
                    case "P":
                        return $this->redirect(['controller' => 'Payments', 'action' => 'view', $idNum]);
                        break;
                    case "T":
                        return $this->redirect(['controller' => 'Attendees', 'action' => 'view', $idNum]);
                        break;
                    case "E":
                        return $this->redirect(['controller' => 'Events', 'action' => 'full_view', $idNum]);
                        break;
                    case "S":
                        return $this->redirect(['controller' => 'Settings', 'action' => 'view', $idNum]);
                        break;
                    default:
                        return $this->redirect(['action' => 'admin_home']);
                }
            }
        }

        if (!is_int($idNum) || $idNum == 0 || is_null($idNum)) {
            $this->Sections = TableRegistry::get('Sections');
            $this->Users = TableRegistry::get('Users');
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
                'conditions' => ['SectionTypes.id' => $section['section_type_id']]
            ];

            $this->Scoutgroups = TableRegistry::get('Scoutgroups');

            $sections = $this->Users->Sections
                ->find(
                    'list',
                    [
                        'keyField' => 'id',
                        'valueField' => 'section',
                        'groupField' => 'scoutgroup.district.district'
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
