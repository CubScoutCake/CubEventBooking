<?php
namespace App\Controller\Admin;

/**
 * Scoutgroups Controller
 *
 * @property \App\Model\Table\ScoutgroupsTable $Scoutgroups
 */
class ScoutgroupsController extends AppController
{

    /**
     * setup config
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'lookup']
        ]);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Scoutgroups
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->query])
            // You can add extra things to the query if you need to
            ->contain(['Districts']);

        $districts = $this->Scoutgroups->Districts->find('list');

        $this->set(compact('districts'));

        $this->set('scoutgroups', $this->paginate($query));
        $this->set('_serialize', ['scoutgroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Scoutgroup id.
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $scoutgroup = $this->Scoutgroups->get($id, [
            'contain' => ['Districts', 'Sections.Applications.Events', 'Sections.Applications.Users', 'Sections.Attendees.Roles', 'Sections.Attendees.Users', 'Sections.Users.Roles']
        ]);
        $this->set('scoutgroup', $scoutgroup);
        $this->set('_serialize', ['scoutgroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $scoutgroup = $this->Scoutgroups->newEntity();
        if ($this->request->is('post')) {
            $scoutgroup = $this->Scoutgroups->patchEntity($scoutgroup, $this->request->getData());
            if ($this->Scoutgroups->save($scoutgroup)) {
                $this->Flash->success(__('The scoutgroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scoutgroup could not be saved. Please, try again.'));
            }
        }
        $districts = $this->Scoutgroups->Districts->find('list', ['limit' => 200]);
        $this->set(compact('scoutgroup', 'districts'));
        $this->set('_serialize', ['scoutgroup']);
    }

    /**
     * Edit method
     *
     * @param int $id the ID of the Scout Group.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $scoutgroup = $this->Scoutgroups->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $scoutgroup = $this->Scoutgroups->patchEntity($scoutgroup, $this->request->getData());
            if ($this->Scoutgroups->save($scoutgroup)) {
                $this->Flash->success(__('The scoutgroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scoutgroup could not be saved. Please, try again.'));
            }
        }
        $districts = $this->Scoutgroups->Districts->find('list', ['limit' => 200]);
        $this->set(compact('scoutgroup', 'districts'));
        $this->set('_serialize', ['scoutgroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Scoutgroup id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $scoutgroup = $this->Scoutgroups->get($id);
        if ($this->Scoutgroups->delete($scoutgroup)) {
            $this->Flash->success(__('The scoutgroup has been deleted.'));
        } else {
            $this->Flash->error(__('The scoutgroup could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
