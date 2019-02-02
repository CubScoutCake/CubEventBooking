<?php
namespace App\Controller\Admin;

/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 *
 * @property \App\Controller\Component\ProgressComponent $Progress
 * @property \App\Controller\Component\LineComponent $Line
 * @property \App\Controller\Component\AvailabilityComponent $Availability
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

            $event = $this->Applications->Events->get($eventID);

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
     * @param string|null $applicationId Application id.
     *
     * @return void
     *
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     * @throws \Exception
     */
    public function view($applicationId = null)
    {
        $application = $this->Applications->get($applicationId, [
            'contain' => ['Users', 'Sections.Scoutgroups.Districts', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Sections.Scoutgroups', 'Allergies'], 'Notes']
        ]);
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), true);
    }

    /**
     * Views the application in PDF
     *
     * @param null $applicationId ID of the Application
     *
     * @throws \Exception
     *
     * @return void
     */
    public function pdfView($applicationId = null)
    {
        // Insantiate Objects
        $application = $this->Applications->get($applicationId, [
            'contain' => ['Users', 'Sections.Scoutgroups.Districts', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Sections.Scoutgroups', 'Allergies'], 'Notes']
        ]);
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), true);

        $this->viewBuilder()->setOptions([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice_' . $applicationId
               ]
           ]);

        $this->Progress->determineApp($application->id, true, $this->Auth->user('id'), true);

        $cakePDF = new \CakePdf\Pdf\CakePdf();
        $cakePDF->template('application', 'default');
        $this->set($cakePDF->viewVars());

        $cakePDF->write(FILES . DS . 'Event ' . $application->id . DS . 'Applications' . DS . 'Application #' . $applicationId . '.pdf');

        $this->redirect(['controller' => 'Applications', 'action' => 'view', $application->id, '_ext' => 'pdf']);
    }

    /**
     * Add method
     *
     * @param int $userId The Id of the User to be have the Application Created for
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     *
     * @throws \Exception
     */
    public function add($userId = null)
    {
        if (isset($userId)) {
            /**
             * @var \App\Model\Entity\User $user
             */
            $user = $this->Applications->Users->get($userId, ['contain' => ['Roles', 'Applications', 'Sections.Scoutgroups']]);
            $userSectionId = $user->section_id;
        }

        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            $newData = [
                'modification' => 0,
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
     * @param string|null $applicationId Application id.
     *
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($applicationId = null)
    {
        $application = $this->Applications->get($applicationId, [
            'contain' => ['Attendees', 'Events.EventTypes.ApplicationRefs', 'Sections.Scoutgroups', 'Users']
        ]);

        $permitHolderBool = $application->event->event_type->permit_holder;
        $teamLeaderBool = $application->event->event_type->team_leader;
        $term = $application->event->event_type->application_ref->text;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->getData());
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
     * @param int $applicationId LinkID
     *
     * @return \Cake\Http\Response|null
     */
    public function link($applicationId = null)
    {
        $application = $this->Applications->get($applicationId, [
            'contain' => ['Attendees', 'Events', 'Sections.Scoutgroups', 'Users']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->getData());
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
     * @param string|null $applicationId Application id.
     *
     * @return \Cake\Http\Response Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($applicationId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $application = $this->Applications->get($applicationId);
        if ($this->Applications->delete($application)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
