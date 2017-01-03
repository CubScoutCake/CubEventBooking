<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ResetForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('scoutgroup', 'integer')
            ->addField('email', 'varchar');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->requirePresence('scoutgroup');

        $validator->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email')
            ->notEmpty('email');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}
