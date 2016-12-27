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
namespace App\Controller\Admin;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

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
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function adminHome()
    {
        // Get Entities from Registry
        $apps = TableRegistry::get('Applications');
        $evs = TableRegistry::get('Events');
        $invs = TableRegistry::get('Invoices');
        $usrs = TableRegistry::get('Users');
        $pays = TableRegistry::get('Payments');
        $sets = TableRegistry::get('Settings');
        $atts = TableRegistry::get('Attendees');
        $nts = TableRegistry::get('Notes');
        $notifs = TableRegistry::get('Notifications');

        $userId = $this->Auth->user('id');

        // Table Entities
        $applications = $apps->find()->contain(['Users', 'Scoutgroups'])->order(['Applications.modified' => 'DESC'])->limit(10);
        $events = $evs->find('upcoming')->contain(['Settings'])->order(['Events.start_date' => 'ASC']);
        $invoices = $invs->find()->contain(['Users', 'Applications'])->order(['Invoices.modified' => 'DESC'])->limit(10);
        $users = $usrs->find()->contain(['Roles', 'Scoutgroups'])->order(['Users.last_login' => 'DESC'])->limit(10);
        $payments = $pays->find()->contain(['Invoices'])->order(['Payments.created' => 'DESC'])->limit(10);
        $notes = $nts->find()->contain(['Invoices', 'Applications', 'Users'])->order(['Notes.modified' => 'DESC'])->limit(10);
        $notifications = $notifs->find()->contain(['Notificationtypes', 'Users'])->order(['Notifications.created' => 'DESC'])->limit(10);

        // Pass to View
        $this->set(compact('applications', 'events', 'invoices', 'users', 'payments', 'notes', 'notifications'));

        // Counts of Entities
        $cntApplications = $apps->find('all')->count('*');
        $cntEvents = $evs->find('all')->count('*');
        $cntInvoices = $invs->find('all')->count('*');
        $cntUsers = $usrs->find('all')->count('*');
        $cntPayments = $pays->find('all')->count('*');
        $cntAttendees = $atts->find('all')->count('*');

        // Pass to View
        $this->set(compact('cntApplications', 'cntEvents', 'cntInvoices', 'cntUsers', 'cntPayments', 'cntAttendees', 'userId'));
    }

    public function link($ent = null)
    {
        if (is_null($ent)) {
            $ent = $this->request->data['link'];
        }

        if (is_null($ent)) {
            return $this->redirect(['action' => 'admin_home']);
        }

        $entStr = strtoupper($ent);

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
}
