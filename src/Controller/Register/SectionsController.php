<?php
namespace App\Controller\Register;

use App\Controller\Register\AppController;
use Cake\Utility\Text;

/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 */
class SectionsController extends AppController
{
    /**
     * Select method
     *
     * @param int|null $eventId an Event Id to proceed with - will be set to the session.
     *
     * @return \Cake\Network\Response|void Value to be returned
     */
    public function select($eventId = null)
    {
        if ($this->request->is('post')) {
            $groupId = $this->request->data['scoutgroup_id'];
            $typeId = $this->request->data['section_type_id'];

            $this->redirect(['action' => 'existing', $groupId, $typeId]);
        }
        $sectionTypes = $this->Sections->SectionTypes->find('list', ['limit' => 200])->order(['lower_age' => 'ASC']);
        $scoutgroups = $this->Sections->Scoutgroups->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district'
            ]
        ) ->contain(['Districts']);
        $section = $this->Sections->newEntity();
        $this->set(compact('section', 'sectionTypes', 'scoutgroups'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Existing method - to find current sections.
     *
     * @param int|null $groupId A groupId for searching.
     * @param int|null $typeId A SectionTypeId for searching.
     *
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function existing($groupId = null, $typeId = null)
    {
        if (!isset($groupId) || !isset($typeId)) {
            return $this->redirect(['controller' => 'Sections', 'prefix' => 'register', 'action' => 'select']);
        }

        $existing = $this->Sections->find('list')->where(['scoutgroup_id' => $groupId, 'section_type_id' => $typeId]);
        $this->set(compact('existing'));

        if ($existing->count() == 0) {
            $this->Flash->success(__('No existing sections were found. Please create a new one.'));
            $this->redirect(['action' => 'add', $groupId, $typeId]);
        }

        $section = $this->Sections->newEntity();
        if ($this->request->is('post')) {
            $redir = $this->request->data['_ids'];
            $this->redirect(['controller' => 'Users', 'action' => 'register', 'prefix' => 'register', $redir]);
        }

        $this->set(compact('section', 'groupId', 'typeId'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Add method
     *
     * @param int|null $groupId A groupId for searching.
     * @param int|null $typeId A SectionTypeId for searching.
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($groupId = null, $typeId = null)
    {
        if (!isset($groupId) || !isset($typeId)) {
            return $this->redirect(['controller' => 'Sections', 'prefix' => 'register', 'action' => 'select']);
        }

        $this->request->data['scoutgroup_id'] = $groupId;
        $this->request->data['section_type_id'] = $typeId;

        if ($this->request->is('get')) {
            $group = $this->Sections->Scoutgroups->get($groupId);
            $type = $this->Sections->SectionTypes->get($typeId);

            $suggestion = Text::truncate($group['scoutgroup'], 8, ['ellipsis' => false]) . ' - ' . $type['section_type'];

            $this->request->data['section'] = $suggestion;
        }

        $section = $this->Sections->newEntity();
        if ($this->request->is('post')) {
            $section = $this->Sections->patchEntity($section, $this->request->data, [
                'fieldList' => [
                    'section_type_id',
                    'scoutgroup_id',
                    'section',
                ]]);
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));
                $redir = $section->get('id');
                if (is_null($this->Auth->user(['User.id']))) {
                    $this->redirect(['controller' => 'Users', 'action' => 'register', $redir]);
                }
                $this->redirect(['controller' => 'Sections', 'prefix' => false, 'action' => 'view', $redir]);
            } else {
                $this->Flash->error(__('The section could not be saved. Please, try again.'));
                $this->log('Register:Sections:Add - Fail - Could not be saved.', 'notice');
            }
        }
        $sectionTypes = $this->Sections->SectionTypes->find('list', ['limit' => 200]);
        $scoutgroups = $this->Sections->Scoutgroups->find('list', ['limit' => 200]);
        $this->set(compact('section', 'sectionTypes', 'scoutgroups'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Authorisation Function,
     *
     * @param \Cake\Event\Event $event The CakePHP Event Trigger
     *
     * @return void
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['select', 'add', 'existing']);
    }
}
