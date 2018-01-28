<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Http\Client;
use Cake\ORM\TableRegistry;

/**
 * Attendees Controller
 *
 * @property \App\Model\Table\AttendeesTable $Attendees
 */
class AttendeesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Sections.Scoutgroups', 'Roles'],
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ];
        $this->set('attendees', $this->paginate($this->Attendees));
        $this->set('_serialize', ['attendees']);
    }

    /**
     * View method
     *
     * @param string|null $AttID Attendee id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($AttID = null)
    {
        $attendee = $this->Attendees->get($AttID, [
            'contain' => ['Users', 'Sections.Scoutgroups', 'Roles', 'Applications.Sections.Scoutgroups', 'Applications.Events', 'Allergies']
        ]);
        $this->set('attendee', $attendee);
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Add method
     *
     * @param int $appId The ID of the Application to attach the Adult
     *
     * @return mixed - Redirects on successful add, renders view otherwise.
     */
    public function adult($appId = null)
    {
        $attendee = $this->Attendees->newEntity();

        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);

            $phone1 = $attendee->phone;
            $phone2 = $attendee->phone2;

            $phone1 = str_replace(' ', '', $phone1);
            $phone1 = str_replace('-', '', $phone1);
            $phone1 = str_replace('/', '', $phone1);
            $phone1 = substr($phone1, 0, 5) . ' ' . substr($phone1, 5);

            if (!empty($phone2)) {
                $phone2 = str_replace(' ', '', $phone2);
                $phone2 = str_replace('-', '', $phone2);
                $phone2 = str_replace('/', '', $phone2);
                $phone2 = substr($phone2, 0, 5) . ' ' . substr($phone2, 5);
            }

            $phoneAttendee = [
                'phone' => $phone1,
                'phone2' => $phone2
                ];

            $attendee = $this->Attendees->patchEntity($attendee, $phoneAttendee);

            $attendee->user_id = $this->Auth->user('id');

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The Adult has been saved.'));

                $adult = $this->Attendees->get($attendee->id, ['contain' => ['Roles', 'Sections.Scoutgroups.Districts']]);

                $adultEnt = [
                    'Entity Id' => $adult->id,
                    'Controller' => 'Attendees',
                    'Action' => 'Add',
                    'User Id' => $this->Auth->user('id'),
                    'Creation Date' => $adult->created,
                    'Modified' => $adult->modified,
                    'Attendee' => [
                        'Role' => $adult->role->role,
                        'Invested' => $adult->role->invested,
                        'Minor' => $adult->role->minor,
                        'Last Name' => $adult->lastname,
                        'Scoutgroup' => $adult->sections->scoutgroup->scoutgroup,
                        'District' => $adult->sections->scoutgroup->district->district
                        ]
                    ];

                $sets = TableRegistry::get('Settings');

                $jsonAdd = json_encode($adultEnt);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonAdd,
                    ['type' => 'json']
                );

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Adult could not be saved. Please, try again.'));
            }
        }

        $sections = $this->Attendees->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('section_id')]]);
        $roles = $this->Attendees->Roles->find('nonAuto')->find('adults')->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'sections', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['application_id'] = $appId;
        }
    }

    /**
     * Create a Young Person
     *
     * @param null $appId The Application to add the Attendee to
     *
     * @return \Cake\Network\Response|null
     */
    public function cub($appId = null)
    {
        $attendee = $this->Attendees->newEntity();
        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);

            $attendee->user_id = $this->Auth->user('id');

            $phone1 = $attendee->phone;
            $phone2 = $attendee->phone2;

            $phone1 = str_replace(' ', '', $phone1);
            $phone1 = str_replace('-', '', $phone1);
            $phone1 = str_replace('/', '', $phone1);
            $phone1 = substr($phone1, 0, 5) . ' ' . substr($phone1, 5);

            if (!empty($phone2)) {
                $phone2 = str_replace(' ', '', $phone2);
                $phone2 = str_replace('-', '', $phone2);
                $phone2 = str_replace('/', '', $phone2);
                $phone2 = substr($phone2, 0, 5) . ' ' . substr($phone2, 5);
            }

            $phoneAttendee = [
                'phone' => $phone1,
                'phone2' => $phone2
                ];

            $attendee = $this->Attendees->patchEntity($attendee, $phoneAttendee);

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The Cub has been saved.'));

                $cub = $this->Attendees->get($attendee->id, ['contain' => ['Roles', 'Scoutgroups.Districts']]);

                $cubEnt = [
                    'Entity Id' => $cub->id,
                    'Controller' => 'Attendees',
                    'Action' => 'Add',
                    'User Id' => $this->Auth->user('id'),
                    'Creation Date' => $cub->created,
                    'Modified' => $cub->modified,
                    'Attendee' => [
                        'Role' => $cub->role->role,
                        'Invested' => $cub->role->invested,
                        'Minor' => $cub->role->minor,
                        'Last Name' => $cub->lastname,
                        'Scoutgroup' => $cub->sections->scoutgroup->scoutgroup,
                        'District' => $cub->sections->scoutgroup->district->district
                        ]
                    ];

                $sets = TableRegistry::get('Settings');

                $jsonAdd = json_encode($cubEnt);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonAdd,
                    ['type' => 'json']
                );

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Cub could not be saved. Please, try again.'));
            }
        }

        $sections = $this->Attendees->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('section_id')]]);
        $roles = $this->Attendees->Roles->find('nonAuto')->find('minors')->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'sections', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['application_id'] = $appId;
        }
    }

    /**
     * Edit method
     *
     * @param int $AttID The ID of the Attendee.
     *
     * @return mixed Redirects on successful edit, renders view otherwise.
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($AttID = null)
    {
        $attendee = $this->Attendees->get($AttID, [
            'contain' => ['Applications', 'Allergies', 'Users', 'Sections', 'Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);

            $phone1 = $attendee->phone;
            $phone2 = $attendee->phone2;

            $phone1 = str_replace(' ', '', $phone1);
            $phone1 = str_replace('-', '', $phone1);
            $phone1 = str_replace('/', '', $phone1);
            $phone1 = substr($phone1, 0, 5) . ' ' . substr($phone1, 5);

            if (!empty($phone2)) {
                $phone2 = str_replace(' ', '', $phone2);
                $phone2 = str_replace('-', '', $phone2);
                $phone2 = str_replace('/', '', $phone2);
                $phone2 = substr($phone2, 0, 5) . ' ' . substr($phone2, 5);
            }

            $phoneAttendee = [
                'phone' => $phone1,
                'phone2' => $phone2
                ];

            $attendee = $this->Attendees->patchEntity($attendee, $phoneAttendee);

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $sections = $this->Attendees->Sections->find('list', ['limit' => 200]);
        $roles = $this->Attendees->Roles->find('nonAuto')->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $this->set(compact('attendee', 'users', 'sections', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Delete method
     *
     * @param string|null $AttID Attendee id.
     *
     * @return \Cake\Http\Response Redirects to index.
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($AttID = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendee = $this->Attendees->get($AttID, ['contain' => ['Roles', 'Sections.Scoutgroups.Districts']]);
        if ($this->Attendees->delete($attendee)) {
            $this->Flash->success(__('The attendee has been deleted.'));
        } else {
            $this->Flash->error(__('The attendee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param \App\Model\Entity\User $user The Logged in User
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['index', 'adult', 'cub'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['edit', 'view', 'delete'])) {
            $attendeeId = (int)$this->request->params['pass'][0];
            if ($this->Attendees->isOwnedBy($attendeeId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
}
