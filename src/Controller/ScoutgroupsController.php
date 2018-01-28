<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Scoutgroups Controller
 *
 * @property \App\Model\Table\ScoutgroupsTable $Scoutgroups
 */
class ScoutgroupsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Districts']
        ];
        $this->set('scoutgroups', $this->paginate($this->Scoutgroups));
        $this->set('_serialize', ['scoutgroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Scoutgroup id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $scoutgroup = $this->Scoutgroups->get($id, [
            'contain' => ['Districts', 'Sections', 'Sections.Applications', 'Sections.Attendees', 'Sections.Users']
        ]);
        $this->set('scoutgroup', $scoutgroup);
        $this->set('_serialize', ['scoutgroup']);
    }

/**
 * Add method
 *
 * @return void Redirects on successful add, renders view otherwise.
 */
}
