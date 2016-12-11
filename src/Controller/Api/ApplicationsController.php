<?php

namespace App\Controller\Api;

class ApplicationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        // Set the view vars that have to be serialized.
        $this->set('applications', $this->paginate());
        // Specify which view vars JsonView should serialize.
        $this->set('_serialize', ['applications']);
    }
}