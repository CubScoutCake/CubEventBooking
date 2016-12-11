<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 */
class ApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Attendees']
            , 'conditions' => ['Events.live' => true]
            , 'order' => ['modified' => 'DESC']
        ];

        

        $this->set('applications', $this->paginate($this->Applications));
        $this->set('_serialize', ['applications']);
    }

    public function bookings($eventID = null)
    {
        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Attendees', 'Invoices'],
            'conditions' => ['event_id' => $eventID]
        ];
        $this->set('applications', $this->paginate($this->Applications));
        $this->set('_serialize', ['applications']);
    }

    /**
     * View method
     *
     * @param string|null $id Application id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Scoutgroups', 'Allergies'], 'Notes']
        ]);
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), true);
    }

    public function pdfView($id = null)
    {
        // Insantiate Objects
        $application = $this->Applications->get($id, [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Scoutgroups', 'Allergies'], 'Notes']
        ]);

        $this->viewBuilder()->options([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice_' . $id
               ]
           ]);
        
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $evts = TableRegistry::get('Events');

        $event = $evts->get($application->event_id);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), true);

        $CakePdf = new \CakePdf\Pdf\CakePdf();
        $CakePdf->template('application', 'default');
        $CakePdf->viewVars($this->viewVars);
        // Get the PDF string returned
        $pdf = $CakePdf->output();
        // Or write it to file directly
        $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Applications' . DS . 'Application #' . $id . '.pdf');

        $this->redirect(['controller' => 'Applications', 'action' => 'view', $application->id, '_ext' => 'pdf']);
    }

    public function eventPdf($eventId = null)
    {
        if (isset($eventId)) {
            $invs = TableRegistry::get('Invoices');
            $atts = TableRegistry::get('Attendees');
            $itms = TableRegistry::get('InvoiceItems');
            $evts = TableRegistry::get('Events');

            $event = $evts->get($eventId, ['contain' => ['Applications']]);

            foreach ($event->applications as $applications) {
                // Insantiate Objects
                $application = $this->Applications->get($applications->id, [
                    'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Scoutgroups', 'Allergies'], 'Notes']
                ]);

                $this->viewBuilder()->options([
                       'pdfConfig' => [
                           'orientation' => 'portrait',
                           'filename' => 'Application ' . $application->id
                       ]
                   ]);
                
                $this->set('application', $application);
                $this->set('_serialize', ['application']);

                $this->loadComponent('Progress');

                $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), true, true, false);

                $CakePdf = new \CakePdf\Pdf\CakePdf();
                $CakePdf->template('application', 'default');
                $CakePdf->viewVars($this->viewVars);
                // Get the PDF string returned
                $pdf = $CakePdf->output();
                // Or write it to file directly
                $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Applications' . DS . 'Application #' . $application->id . '.pdf');
            }
        }

        $this->redirect(['controller' => 'Events', 'action' => 'full_view', $event->id]);
    }

    public function queryApp($appID = null)
    {
        if (!isset($appID)) {
            $this->redirect(['action' => 'index']);
        }

        $application = $this->Applications->get($id, [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Scoutgroups', 'Allergies'], 'Notes']
        ]);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), false, false);

        if ($simpleResults->done != 1) {
            $this->redirect(['controller' => 'Notifications', 'action' => 'index']);
        }
    }

    public function queryEvent($eventID = null)
    {
        if (!isset($eventID)) {
            $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        if (isset($userId)) {
            $usrs = TableRegistry::get('Users');

            $user = $usrs->get($userId, ['contain' => ['Roles', 'Applications', 'Scoutgroups']]);
            $userScoutGroup = $user->scoutgroup_id;
        }

        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            $newData = ['modification' => 0];
            $application = $this->Applications->patchEntity($application, $newData);

            $application = $this->Applications->patchEntity($application, $this->request->data);

            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'view', $application->id]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        
        if (isset($userId)) {
            $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userId]]);
        } else {
            $attendees = $this->Applications->Attendees->find('list', ['limit' => 200]);
        }

        $users = $this->Applications->Users->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'full_name',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $scoutgroups = $this->Applications->Scoutgroups->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district'
            ]
        )
            ->contain(['Districts']);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);
        
        $this->set(compact('application', 'users', 'attendees', 'scoutgroups', 'events'));
        $this->set('_serialize', ['application']);

        //$startuser = $this->Applications->Users->find('all',['conditions' => ['user_id' => $userId]])->first()->user_id;

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['user_id'] = $userId;
            if (isset($userScoutGroup)) {
                $this->request->data['scoutgroup_id'] = $userScoutGroup;
            }
        }  
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Events', 'Scoutgroups', 'Users']
        ]);

        $users = TableRegistry::get('Users');
        $user = $users->get($application->user_id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'view', $application->id]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        $users = $this->Applications->Users->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'full_name',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $application->user_id]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);
        $scoutgroups = $this->Applications->Scoutgroups->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district'
            ]
        )
            ->contain(['Districts']);
        $this->set(compact('application', 'users', 'attendees', 'events', 'scoutgroups'));
        $this->set('_serialize', ['application']);
    }

    public function link($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Events', 'Scoutgroups', 'Users']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'view', $application->id]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $application->user_id]]);
        $this->set(compact('application', 'attendees'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $application = $this->Applications->get($id);
        if ($this->Applications->delete($application)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {

        // Admin can access every action
        if (isset($user['authrole']) && $user['authrole'] === 'admin') {
            return true;
        }

        if ($this->request->action === 'add') {
                return true;
        }

        if (in_array($this->request->action, ['edit', 'delete'])) {
            if ($this->applications->isOwnedBy($application['user_id'], $user['id'])) {
                return true;
            }

            // Check that the application belongs to the current user.
            $application = $this->Applications->get($id);
            
            if ($application->user_id == $user['id']) {
                return true;
            }
        }
    }
}
