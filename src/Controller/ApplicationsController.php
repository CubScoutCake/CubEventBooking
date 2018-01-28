<?php
namespace App\Controller;

use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use CakePdf\Pdf;

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
            'contain' => ['Users', 'Sections.Scoutgroups', 'Events']
        ];
        $this->set('applications', $this->paginate($this->Applications->find('unarchived')->find('ownedBy', ['userId' => $this->Auth->user('id')])));
        $this->set('_serialize', ['applications']);
    }

    /**
     * @param int $eventID The ID of the Event
     */
    public function bookings($eventID = null)
    {
        $this->paginate = [
            'contain' => ['Users', 'Sections.Scoutgroups', 'Events'],
            'conditions' => ['event_id' => $eventID]
        ];
        $this->set('applications', $this->paginate($this->Applications->find('unarchived')->find('ownedBy', ['userId' => $this->Auth->user('id')])));
        $this->set('_serialize', ['applications']);
    }

    /**
     * @param int $applicationID The Application ID
     *
     * @return \Cake\Http\Response|null
     */
    public function invoice($applicationID)
    {
        $this->loadComponent('Line');

        $this->Line->populate($applicationID);

        return $this->redirect(['action' => 'view', $applicationID]);
    }

    /**
     * View method - Displays the Application to the User
     *
     * @param string|null $id Application id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->options([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Application_' . $id
               ]
           ]);

        $application = $this->Applications->get($id, [
            'contain' => [
                'Users',
                'Sections.Scoutgroups.Districts',
                'Events',
                'Invoices',
                'Attendees' => [
                    'sort' => [
                        'Attendees.role_id' => 'ASC'
                        , 'Attendees.lastname' => 'ASC'
                    ]
                ]
                , 'Attendees.Roles' => [
                    'conditions' => [
                        'Attendees.user_id' => $this->Auth->user('id')
                    ]
                ]
                , 'Attendees.Sections.Scoutgroups' => [
                    'conditions' => [
                        'Attendees.user_id' => $this->Auth->user('id')
                    ]
                ]
                , 'Notes' => ['conditions' => ['visible' => true]]]
        ]);

        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, false, $this->Auth->user('id'), true);
    }

    /**
     * @param int $id The ID of the Event
     */
    public function pdfView($id = null)
    {
        // Instantiate Objects
        $application = $this->Applications->get($id, [
            'contain' => [
                'Users',
                'Sections.Scoutgroups',
                'Events',
                'Invoices',
                'Attendees' => [
                    'sort' => [
                        'Attendees.role_id' => 'ASC'
                        , 'Attendees.lastname' => 'ASC'
                    ]
                ]
                , 'Attendees.Roles' => [
                    'conditions' => [
                        'Attendees.user_id' => $this->Auth->user('id')
                    ]
                ]
                , 'Attendees.Sections.Scoutgroups' => [
                    'conditions' => [
                        'Attendees.user_id' => $this->Auth->user('id')
                    ]
                ]
                , 'Notes' => ['conditions' => ['visible' => true]]]
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

        $this->Progress->determineApp($application->id, false, $this->Auth->user('id'), true);

        $CakePdf = new Pdf\CakePdf();
        $CakePdf->template('application', 'default');
        $CakePdf->viewVars($this->viewVars);
        // Get the PDF string returned
        $pdf = $CakePdf->output();
        // Or write it to file directly
        $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Applications' . DS . 'Application #' . $id . '.pdf');

        $this->redirect(['controller' => 'Applications', 'action' => 'view', $application->id, '_ext' => 'pdf']);
    }

    /**
     * @param int $eventID The ID of the event to be booked.
     *
     * @return \Cake\Http\Response|null
     */
    public function book($eventID = null)
    {
        $now = Time::now();

        $evts = TableRegistry::get('Events');

        if (isset($eventID)) {
            $applicationCount = $this->Applications->find('all')->where(['event_id' => $eventID])->count('*');
            $event = $evts->get($eventID);

            if ($applicationCount > $event->available_apps && isset($event->available_apps)) {
                $this->Flash->error(__('Apologies this Event is Full.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }
        }

        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            // Check Max Applications

            $evtID = $this->request->data['event_id'];

            $appCount = $this->Applications->find('all')->where(['event_id' => $evtID])->count('*');
            $event = $evts->get($evtID);

            if ($appCount > $event->available_apps && isset($event->available_apps)) {
                $this->Flash->error(__('Apologies this Event is Full.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } else {
                // Patch Data
                $newData = ['modification' => 0, 'user_id' => $this->Auth->user('id')];
                $application = $this->Applications->patchEntity($application, $newData);

                $application = $this->Applications->patchEntity($application, $this->request->data);

                if ($this->Applications->save($application)) {
                    $redir = $application->get('id');
                    $this->Flash->success(__('The application has been saved.'));

                    return $this->redirect(['action' => 'view', $redir]);
                } else {
                    $this->Flash->error(__('The application could not be saved. Please, try again.'));
                }
            }
        }

        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200, 'conditions' => ['end >' => $now, 'live' => 1]]);
        $this->set(compact('application', 'users', 'events', 'attendees'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Simple Book Method - Single form for a whole booking.
     *
     * @param int $eventId The ID of the Event to be booked
     * @param int $attendees The Quantity of Section Young People
     * @param int $nonSectionAtts The Quantity of Non Section Young People
     * @param int $leaderAtts The Quantity of Adults
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function simpleBook($eventId = null, $attendees = null, $nonSectionAtts = null, $leaderAtts = null)
    {
        if (!isset($eventId) || !isset($attendees)) {
            $this->redirect(['controller' => 'Events', 'action' => 'book', $eventId, $attendees]);
        }

        $this->Events = TableRegistry::get('Events');
        $event = $this->Events->get($eventId, ['contain' => ['EventTypes']]);

        $settings = TableRegistry::get('Settings');
        $term = $settings->get($event->event_type->application_ref_id);
        $term = $term->text;

        if (isset($eventId)) {
            $applicationCount = $this->Applications->find('all')->where(['event_id' => $eventId])->count('*');

            if ($applicationCount > $event->available_apps && isset($event->available_apps)) {
                $this->Flash->error(__('Apologies this Event is Full.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }

            if (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }
        }

        $application = $this->Applications->newEntity();

        $userId = $this->Auth->user('id');
        $users = TableRegistry::get('Users');
        $user = $users->get($userId, ['contain' => ['Sections.SectionTypes.Roles']]);
        $sectionId = $user['section_id'];

        if ($this->request->is('post')) {
            // Patch Data

            $newData = [
                'modification' => 0,
                'user_id' => $userId,
                'section_id' => $sectionId,
                'event_id' => $eventId,
                'invoice' => [
                    'user_id' => $userId,
                ]
            ];

            $application = $this->Applications->patchEntity(
                $application,
                $newData,
                ['associated' => [ 'Invoices' ]]
            );

            $application = $this->Applications->patchEntity(
                $application,
                $this->request->getData(),
                ['associated' => [ 'Attendees', 'Invoices' ]]
            );

            foreach ($application->attendees as $attendee) {
                $attendee['user_id'] = $userId;
                $attendee['section_id'] = $sectionId;
            }

            if ($this->Applications->save($application)) {
                $appId = $application->get('id');

                $this->loadComponent('Line');
                $parse = $this->Line->parseInvoice($application->invoice->id);

                $this->loadComponent('Availability');
                $this->Availability->getNumbers($appId);

                $this->Flash->success(__('Your '. $term . ' has been registered.'));

                if ($parse) {
                    $this->Flash->success(__('Your Invoice has been created automatically.'));
                }

                return $this->redirect(['action' => 'view', $appId]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }

        $sectionType = Inflector::singularize($user->section->section_type->section_type);

        $settings = TableRegistry::get('Settings');
        $termSetting = $settings->get($event->event_type->application_ref_id);

        $term = $termSetting->text;
        $teamLeaderBool = $event->event_type->team_leader;
        $permitHolderBool = $event->event_type->permit_holder;

        $this->set(compact('application', 'teamLeaderBool', 'permitHolderBool', 'term', 'attendees', 'nonSectionAtts', 'leaderAtts', 'sectionType'));

        $sections = $this->Applications->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('section_id')]]);
        $sectionRoles = $this->Applications->Attendees->Roles->find('list', ['limit' => 200])->where(['id' => $user->section->section_type->role_id]);
        $nonSectionRoles = $this->Applications->Attendees->Roles->find('list', ['limit' => 200])->find('nonAuto')->find('minors')->where(['id <>' => $user->section->section_type->role_id]);
        $leaderRoles = $this->Applications->Attendees->Roles->find('list', ['limit' => 200])->find('leaders')->find('nonAuto');

        $this->set(compact('application', 'sectionRoles', 'term', 'nonSectionRoles', 'leaderRoles', 'sections', 'attendees', 'nonSectionAtts', 'leaderAtts', 'sectionType'));
        $this->set('_serialize', ['application']);
    }

    /**
     * @param int $eventID The Internal Event ID
     * @param int $osmEvent The External Online ScoutManager Event ID
     *
     * @return null|\Cake\Http\Response
     */
    public function syncBook($eventID, $osmEvent)
    {
        $this->Events = TableRegistry::get('Events');
        $event = $this->Events->get($eventID, ['contain' => ['EventTypes']]);

        if (isset($eventID)) {
            $applicationCount = $this->Applications->find('all')->where(['event_id' => $eventID])->count('*');

            if ($applicationCount > $event->available_apps && isset($event->available_apps)) {
                $this->Flash->error(__('Apologies this Event is Full.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }

            if (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));

                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }
        }

        $users = TableRegistry::get('Users');
        $user = $users->get($this->Auth->user('id'), ['contain' => ['Sections.SectionTypes.Roles']]);

        $sectionType = Inflector::singularize($user->section->section_type->section_type);

        $settings = TableRegistry::get('Settings');
        $termSetting = $settings->get($event->event_type->application_ref_id);

        $term = $termSetting->text;
        $teamLeaderBool = $event->event_type->team_leader;
        $permitHolderBool = $event->event_type->permit_holder;

        $application = $this->Applications->newEntity(['contain' => 'Attendees']);

        $newData = [
            'modification' => 0,
            'user_id' => $user->id,
            'section_id' => $user->section_id,
            'event_id' => $eventID,
            'osm_event_id' => $osmEvent,
            'invoice' => [
                'user_id' => $user->id,
            ]
        ];

        $application = $this->Applications->patchEntity(
            $application,
            $newData,
            ['associated' => [ 'Invoices', 'Attendees' ]]
        );

        $this->loadComponent('ScoutManager');
        $attendees = $this->ScoutManager->getEventAttendees($this->Auth->user(['id']), $osmEvent);

        $data = [];
        $this->loadComponent('Booking');

        foreach ($attendees as $key => $attendee) {
            $leaderPatrol = false;
            if ($attendee['patrolid'] == -2) {
                $leaderPatrol = true;
            }

            $attendeeArr = [
                'user_id' => $user->id,
                'role_id' => $this->Booking->guessRole($attendee['dob'], $leaderPatrol),
                'firstname' => $attendee['firstname'],
                'lastname' => $attendee['lastname'],
                'osm_id' => $attendee['scoutid'],
                'osm_sync_date' => Time::now(),
                'dateofbirth' => $attendee['dob'],
                'section_id' => $user->section_id
            ];

            array_push($data, $attendeeArr);
        }

        $appData = ['attendees' => $data];
        $this->Applications->patchEntity($application, $appData, ['associated' => ['Invoices', 'Attendees']]);

        $attendeeCount = count($data);

        $this->set(compact('application', 'attendees', 'attendeeCount', 'teamLeaderBool', 'permitHolderBool', 'term', 'sectionType'));

        if ($this->request->is('post')) {
            // Patch Data
            $application = $this->Applications->patchEntity(
                $application,
                $this->request->getData(),
                [
                    'associated' => [ 'Attendees', 'Invoices' ],
                    'fields' => [
                        'permit_holder',
                        'team_leader',
                        'attendees.role_id'
                    ]
                ]
            );

            if ($this->Applications->save($application)) {
                $appId = $application->get('id');

                $this->loadComponent('Availability');

                $this->Availability->getNumbers($appId);

                $this->Flash->success(__('Your '. $term . ' has been registered.'));

                return $this->redirect(['action' => 'view', $appId]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }

        $sections = $this->Applications->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('section_id')]]);
        $roles = $this->Applications->Attendees->Roles->find('nonAuto')->find('list', ['limit' => 200]);

        $this->set(compact('application', 'term', 'roles', 'sections', 'sectionType'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return null|\Cake\Http\Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evts = TableRegistry::get('Events');

        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Sections']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Check Max Applications

            $evtID = $this->request->data['event_id'];

            $appCount = $this->Applications->find('all')->where(['event_id' => $evtID])->count('*');
            $event = $evts->get($evtID);

            /*if ($event->invoices_locked) {
                $this->Flash->error(__('Apologies this Event is Currently Locked.'));
                return $this->redirect(['controller' => 'Applications'
                    , 'action' => 'view'
                    , 'prefix' => false
                    , $id]);
            } else {*/
                $newData = ['user_id' => $this->Auth->user('id'), 'modification' => $application->modification + 1];
                $application = $this->Applications->patchEntity($application, $newData);
                $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
            // }
        }
        $sections = $this->Applications->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'section',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('unarchived')->find('list', ['limit' => 200]);
        $this->set(compact('application', 'users', 'sections', 'events', 'attendees'));
        $this->set('_serialize', ['application']);
    }

    /**
     * @param int $id The ID of the Event to be linked.
     *
     * @return \Cake\Http\Response|null
     */
    public function link($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Sections.Scoutgroups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mod = $application->modification + 1;

            $newData = ['user_id' => $this->Auth->user('id'), 'modification' => $mod];
            $application = $this->Applications->patchEntity($application, $newData);
            $application = $this->Applications->patchEntity($application, $this->request->data);

            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }

            $this->Flash->error(__('The application could not be saved. Please, try again.'));
            // }
        }
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);

        $this->set(compact('application', 'attendees'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return null|\Cake\Http\Response Redirects to index.
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

    /**
     * @param \Cake\ORM\Entity $user User Entity
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['add', 'book', 'index'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['edit', 'view', 'delete'])) {
            $applicationId = (int)$this->request->params['pass'][0];
            if ($this->Applications->isOwnedBy($applicationId, $user['id'])) {
                return true;
            }

            return false;
        }

        return parent::isAuthorized($user);
    }
}
