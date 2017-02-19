<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;


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
     * View method
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

        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $this->loadComponent('Progress');

        $this->Progress->determineApp($application->id, false, $this->Auth->user('id'), true);
    }

    public function pdfView($id = null)
    {
        // Insantiate Objects
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

        $CakePdf = new \CakePdf\Pdf\CakePdf();
        $CakePdf->template('application', 'default');
        $CakePdf->viewVars($this->viewVars);
        // Get the PDF string returned
        $pdf = $CakePdf->output();
        // Or write it to file directly
        $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Applications' . DS . 'Application #' . $id . '.pdf');

        $this->redirect(['controller' => 'Applications', 'action' => 'view', $application->id, '_ext' => 'pdf']);
    }

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

        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('scoutgroup_id')]]);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200, 'conditions' => ['end >' => $now, 'live' => 1]]);
        $this->set(compact('application', 'users', 'Sections.Scoutgroups', 'events', 'attendees'));
        $this->set('_serialize', ['application']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['event_id'] = $eventID;
        }
    }

    /**
     * Simple Book Method - Single form for a whole booking.
     *
     * @param null $eventId
     * @param null $attendees
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function simpleBook($eventId = null, $attendees = null, $nonSectionAtts = null, $leaderAtts = null)
    {
        if (!isset($eventId) || !isset($attendees)) {
            //$this->redirect(['controller' => 'Events', 'action' => 'book', $eventId, $attendees]);
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
            } elseif (!$event->new_apps) {
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
            ];

            $application = $this->Applications->patchEntity(
                $application,
                $newData,
                ['associated' => [ 'Invoices' ]]
            );

            $application = $this->Applications->patchEntity(
                $application,
                $this->request->data,
                ['associated' => [ 'Attendees', 'Invoices' ]]
            );

            foreach ($application->attendees as $attendee) {
                $attendee['user_id'] = $userId;
                $attendee['section_id'] = $sectionId;
            }

            if ($this->Applications->save($application)) {
                $appId = $application->get('id');

                $this->loadComponent('Availability');

                $this->Availability->getNumbers($appId);

                $this->Invoices = TableRegistry::get('Invoices');

                $invoice = $this->Invoices->newEntity();

                $invoiceData = [
                    'user_id' => $userId,
                    'application_id' => $appId,
                ];

                $invoice = $this->Invoices->patchEntity($invoice, $invoiceData, ['validate' => false]);

                if ($this->Invoices->save($invoice)) {
                    $this->Flash->success(__('Your '. $term . ' has been registered.' ));

                    return $this->redirect(['action' => 'view', $appId]);
                }
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

        $this->set(compact('application', 'teamLeaderBool', 'permitHolderBool', 'term',  'attendees', 'nonSectionAtts', 'leaderAtts', 'sectionType'));

        $sections = $this->Applications->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('section_id')]]);
        $sectionRoles = $this->Applications->Attendees->Roles->find('list', ['limit' => 200])->where(['id' => $user->section->section_type->role_id]);
        $nonSectionRoles = $this->Applications->Attendees->Roles->find('list', ['limit' => 200])->find('nonAuto')->find('minors')->where(['id <>' => $user->section->section_type->role_id]);
        $leaderRoles = $this->Applications->Attendees->Roles->find('list', ['limit' => 200])->find('leaders')->find('nonAuto');

        $this->set(compact('application', 'sectionRoles', 'term', 'nonSectionRoles', 'leaderRoles', 'sections', 'attendees', 'nonSectionAtts', 'leaderAtts', 'sectionType'));
        $this->set('_serialize', ['application']);
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
        $evts = TableRegistry::get('Events');

        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Sections.Scoutgroups']
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
                $newData = ['user_id' => $this->Auth->user('id'), 'modification' => 'modification' + 1];
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
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200]);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);
        $this->set(compact('application', 'users', 'scoutgroups', 'events', 'attendees'));
        $this->set('_serialize', ['application']);
    }

    public function link($id = null)
    {
        // $evts = TableRegistry::get('Events');

        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Sections.Scoutgroups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Check Max Applications

            /*$evtID = $this->request->data['event_id'];

            $appCount = $this->Applications->find('all')->where(['event_id' => $evtID])->count('*');
            $event = $evts->get($evtID);*/

            /*if ($event->invoices_locked) {
                $this->Flash->error(__('Apologies this Event is Currently Locked.'));
                return $this->redirect(['controller' => 'Applications'
                    , 'action' => 'view'
                    , 'prefix' => false
                    , $id]);
            } else {*/
                $newData = ['user_id' => $this->Auth->user('id'), 'modification' => 'modification' + 1];
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
