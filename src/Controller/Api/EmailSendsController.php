<?php
declare(strict_types=1);

namespace App\Controller\Api;

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
     * @return void
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
