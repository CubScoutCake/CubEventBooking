<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class InvForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('cubs', 'integer')
            ->addField('yls', 'integer')
            ->addField('leaders', 'integer');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->allowEmpty('cubs');

        $validator->allowEmpty('yls');

        $validator->allowEmpty('leaders');

        return $validator;

    }

    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}
