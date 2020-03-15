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

namespace App\Controller;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Model\Table\ApplicationsTable $Applications
 * @property \App\Model\Table\AttendeesTable $Attendees
 * @property \App\Model\Table\InvoicesTable $Invoices
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class LandingController extends AppController
{
    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function userHome()
    {
        // Get Entities from Registry
        $this->loadModel('Applications');
        $this->loadModel('Attendees');
        $this->loadModel('Invoices');
        $this->loadModel('Payments');
        $this->loadModel('Events');

        $userId = $this->Auth->user('id');

        // Table Entities
        $applications = $this->Applications
            ->find('all', ['conditions' => ['Applications.user_id' => $userId]])
            ->contain(['Events', 'Sections.Scoutgroups'])
            ->order(['Applications.modified' => 'DESC'])
            ->limit(5);
        $events = $this->Events
            ->find('upcoming')
            ->find('unarchived')
            ->contain(['EventStatuses', 'EventTypes'])
            ->limit(3)
            ->order(['Events.start_date' => 'ASC']);
        $invoices = $this->Invoices
            ->find('all', [
                'conditions' => [
                    'Invoices.user_id' => $userId,
                ],
            ])
            ->contain(['Users', 'Applications', 'Payments'])
            ->order(['Invoices.created' => 'DESC'])
            ->limit(5);
        $payments = $this->Payments->find('all')->matching('Invoices', function ($q) {
            return $q->where(['Invoices.user_id' => $this->Auth->user('id')]);
        });

        if ($events->count() > 0) {
            $this->set(compact('events'));
        }

        // Pass to View
        $this->set(compact('applications', 'invoices', 'payments'));

        // Counts of Entities
        $countApplications = $applications->count();
        $countInvoices = $invoices->count();
        $countPayments = $payments->count();
        $countAttendees = $this->Attendees->find('all', ['conditions' => ['user_id' => $userId]])->count();

        // Pass to View
        $this->set(compact('countApplications', 'countAttendees', 'countInvoices', 'countPayments', 'userId'));
    }

    /**
     * @return \Cake\Http\Response|void
     */
    public function welcome()
    {
        // Set the layout.
        $this->viewBuilder()->setLayout('public');

        $this->Events = $this->getTableLocator()->get('Events');
        $events = $this->Events->find('upcoming')->contain(['EventStatuses', 'EventTypes']);
        $this->set(compact('events'));
    }

    /**
     * @param \Cake\Event\Event $event The CakePHP emissive Event
     *
     * @return \Cake\Event\Event
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['welcome']);

        return $event;
    }
}
