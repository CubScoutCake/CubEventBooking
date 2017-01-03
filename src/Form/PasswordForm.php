<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class PasswordForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('newpw', ['type' => 'string'])
            ->addField('confirm', ['type' => 'string'])
            ->addField('postcode', ['type' => 'string']);
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->requirePresence('newpw')
            ->notEmpty('newpw');

        $validator->requirePresence('confirm')
            ->notEmpty('confirm');

        $validator->requirePresence('postcode')
            ->notEmpty('postcode');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}
