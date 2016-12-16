<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class LinkForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('osm_email', 'string')
            ->addField('osm_password', 'string');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->add('osm_email', 'valid', ['rule' => 'email'])
            ->requirePresence('osm_email', 'create')
            ->notEmpty('osm_email');

        $validator
            //->add('osm_password', 'valid', ['rule' => 'string'])
            ->requirePresence('osm_password', 'create')
            ->notEmpty('osm_password');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}
