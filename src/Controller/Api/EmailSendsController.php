<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * EmailSends Controller
 *
 * @property \App\Model\Table\EmailSendsTable $EmailSends
 */
class EmailSendsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function update()
    {
        $this->request->allowMethod('post');

        $updateRequest = $this->request->getData();

        $updateRequest = $updateRequest['results'];

        //$updateRequest = json_decode($updateRequest);

        $this->set(compact('updateRequest'));
    }
}
