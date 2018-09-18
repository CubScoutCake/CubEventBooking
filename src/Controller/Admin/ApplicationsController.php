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
     * @param int $eventID The ID of an Event
     *
     * @return void
     */
    public function index($eventID = null)
    {
        $query = $this->Applications->find('all');

        if (!is_null($eventID)) {
            $query->where(['event_id' => $eventID]);

            $events = TableRegistry::get('Events');
            $event = $events->get($eventID);

            $title = $event->name . ' Bookings';
        } else {
            $query->where(['Events.live' => true]);

            $title = 'All Applications';
        }

        $query
            ->contain(['Users', 'Sections.Scoutgroups.Districts', 'Events', 'Attendees'])
            ->orderDesc('Applications.modified');

        $this->set('applications', $this->paginate($query));
        $this->set('_serialize', ['applications']);
        $this->set('page_title', $title);
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
            'contain' => ['Users', 'Sections.Scoutgroups.Districts', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Sections.Scoutgroups', 'Allergies'], 'Notes']
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
            'contain' => ['Users', 'Sections.Scoutgroups.Districts', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Sections.Scoutgroups', 'Allergies'], 'Notes']
        ]);
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), true);

        $this->viewBuilder()->setOptions([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice_' . $id
               ]
           ]);

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
            $evts = TableRegistry::get('Events');

            $event = $evts->get($eventId, ['contain' => ['Applications']]);

            foreach ($event->applications as $applications) {
                // Insantiate Objects
                $application = $this->Applications->get($applications->id, [
                    'contain' => ['Users', 'Sections.Scoutgroups.Districts', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Sections.Scoutgroups', 'Allergies'], 'Notes']
                ]);
                $this->set('application', $application);
                $this->set('_serialize', ['application']);

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
     * @param int $userId The Id of the User to be have the Application Created for
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        if (isset($userId)) {
            $usrs = TableRegistry::get('Users');

            $user = $usrs->get($userId, ['contain' => ['Roles', 'Applications', 'Sections.Scoutgroups']]);
            $userSectionId = $user->section_id;
        }

        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            $newData = [
                'modification' => 0,
                'invoice'      => [ 'user_id' => $user->id, ],
                ];
            $appData = array_merge($newData, $this->request->getData());
            $application = $this->Applications->patchEntity($application, $appData);

            if ($this->Applications->save($application)) {
                $appId = $application->get('id');
                $application = $this->Applications->get($appId, ['contain' => ['Invoices']]);

                $this->loadComponent('Line');
                $parse = $this->Line->parseInvoice($application->invoice->id);

                $this->loadComponent('Availability');
                $this->Availability->getNumbers($appId);

                $this->Flash->success(__('Application has been registered.'));

                if ($parse) {
                    $this->Flash->success(__('Invoice created.'));
                }

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
                'groupField' => 'sections.scoutgroup.district.district'
            ]
        )
            ->contain(['Sections.Scoutgroups.Districts']);
        $sections = $this->Applications->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'section',
                'groupField' => 'scoutgroup.scoutgroup'
            ]
        )
            ->contain(['Scoutgroups']);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);

        $this->set(compact('application', 'users', 'attendees', 'sections', 'events'));
        $this->set('_serialize', ['application']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request = $this->request->withData('user_id', $userId);
            if (isset($userSectionId)) {
                $this->request = $this->request->withData('section', $userSectionId);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Events.EventTypes.ApplicationRefs', 'Sections.Scoutgroups', 'Users']
        ]);

        $permitHolderBool = $application->event->event_type->permit_holder;
        $teamLeaderBool = $application->event->event_type->team_leader;
        $term = $application->event->event_type->application_ref->text;

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
                'groupField' => 'section.scoutgroup.district.district'
            ]
        )
            ->contain(['Sections.Scoutgroups.Districts']);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $application->user_id]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);
        $sections = $this->Applications->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'section',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $this->set(compact('application', 'users', 'attendees', 'events', 'sections', 'permitHolderBool', 'teamLeaderBool', 'term'));
        $this->set('_serialize', ['application']);
    }

    /**
     * @param int $id LinkID
     *
     * @return \Cake\Http\Response|null
     */
    public function link($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Events', 'Sections.Scoutgroups', 'Users']
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
     * @return \Cake\Http\Response Redirects to index.
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
}
