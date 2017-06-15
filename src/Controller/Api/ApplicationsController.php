<?php

namespace App\Controller\Api;

class ApplicationsController extends AppController
{
    /**
     * Setup Config
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Display a set of Applications in the Response
     *
     * @return void
     */
    public function index()
    {
        $this->request->allowMethod('get');

        $applications = $this->Applications->find('all', [
            'fields' => [
                'id',
                'permit_holder',
                'team_leader',
                'event_id',
            ]
        ]);

        // Set the view vars that have to be serialized.
        $this->set('applications', $applications);
        // Specify which view vars JsonView should serialize.
        $this->set('_serialize', ['applications']);
    }
}
