<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notificationtypes Controller
 *
 * @property \App\Model\Table\NotificationtypesTable $Notificationtypes
 */
class NotificationtypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('notificationtypes', $this->paginate($this->Notificationtypes));
        $this->set('_serialize', ['notificationtypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Notificationtype id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notificationtype = $this->Notificationtypes->get($id, [
            'contain' => ['Notifications']
            ,'condtions' => ['user_id' => $this->Auth->user('id')]
        ]);
        $this->set('notificationtype', $notificationtype);
        $this->set('_serialize', ['notificationtype']);
    }
}
