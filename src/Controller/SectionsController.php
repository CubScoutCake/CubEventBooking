<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Text;

/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 */
class SectionsController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SectionTypes', 'Scoutgroups'],
        ];
        $sections = $this->paginate($this->Sections);

        $this->set(compact('sections'));
        $this->set('_serialize', ['sections']);
    }

    /**
     * View method
     *
     * @param string|null $id Section id.
     *
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => ['SectionTypes', 'Scoutgroups.Districts', 'Applications', 'Users'],
        ]);

        $this->set('section', $section);
        $this->set('_serialize', ['section']);
    }

    /**
     * Edit method
     *
     * @param string|null $sectionId Section id.
     *
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($sectionId = null)
    {
        $section = $this->Sections->get($sectionId);

        if (
            $this->Auth->user('section_id') <> $section->id
            && ! is_null($section->cc_users)
            && $section->cc_users == 1
        ) {
            $this->Flash->error('You can only edit your own section');
            $errorMsg = 'SECTION:EDIT:'
                        . $section->id
                        . ' edited without authorisation User:'
                        . $this->Auth->user('id');
            $this->log($errorMsg, 'notice');

            return $this->redirect(['action' => 'view']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $section = $this->Sections->patchEntity($section, $this->request->getData());
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section could not be saved. Please, try again.'));
            }
        }
        $sectionTypes = $this->Sections->SectionTypes->find('list', ['limit' => 200]);
        $scoutgroups = $this->Sections->Scoutgroups->find('list', ['limit' => 200]);
        $this->set(compact('section', 'sectionTypes', 'scoutgroups'));
        $this->set('_serialize', ['section']);
    }

    /**
     * Select method
     *
     * @return \Cake\Http\Response|void Value to be returned
     */
    public function select()
    {
        if ($this->request->is('post')) {
            $groupId = $this->request->getData('scoutgroup_id');
            $typeId = $this->request->getData('section_type_id');

            $this->redirect(['action' => 'existing', $groupId, $typeId]);
        }
        $sectionTypes = $this->Sections->SectionTypes
            ->find('list', ['limit' => 200])
            ->order(['lower_age' => 'ASC']);
        $scoutgroups = $this->Sections->Scoutgroups->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district',
            ]
        )->contain(['Districts']);
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
     * @return mixed
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function existing($groupId = null, $typeId = null)
    {
        if (! isset($groupId) || ! isset($typeId)) {
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
            $redir = $this->request->getData()['_ids'];
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
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($groupId = null, $typeId = null)
    {
        if (! isset($groupId) || ! isset($typeId)) {
            return $this->redirect(['controller' => 'Sections', 'prefix' => 'register', 'action' => 'select']);
        }

        $this->request->getData()['scoutgroup_id'] = $groupId;
        $this->request->getData()['section_type_id'] = $typeId;

        if ($this->request->is('get')) {
            $group = $this->Sections->Scoutgroups->get($groupId);
            $type = $this->Sections->SectionTypes->get($typeId);

            $suggestion = Text::truncate($group['scoutgroup'], 8, ['ellipsis' => false])
                          . ' - ' . $type['section_type'];

            $this->request->getData()['section'] = $suggestion;
        }

        $section = $this->Sections->newEntity();
        if ($this->request->is('post')) {
            $section = $this->Sections->patchEntity($section, $this->request->getData(), [
                'fieldList' => [
                    'section_type_id',
                    'scoutgroup_id',
                    'section',
                ],
            ]);
            $section = $section->set('validated', true);
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
}
