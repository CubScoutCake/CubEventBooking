<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class InvcanForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('cubs', 'integer')
            ->addField('yls', 'integer')
            ->addField('leaders', 'integer')
            ->addField('cancelled_cubs', 'integer')
            ->addField('cancelled_yls', 'integer')
            ->addField('cancelled_leaders', 'integer');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->allowEmpty('cubs');

        $validator->allowEmpty('yls');

        $validator->allowEmpty('leaders');

        $validator->allowEmpty('cancelled_cubs');

        $validator->allowEmpty('cancelled_yls');

        $validator->allowEmpty('cancelled_leaders');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}
