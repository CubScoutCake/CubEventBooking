<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class DirectForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('id', 'int');
        return $schema->addField('controller', 'int');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->add('controller', 'valid', ['rule' => 'numeric'])
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        return $this->redirect->;
    }
}
