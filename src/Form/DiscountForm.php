<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class DiscountForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('discount', 'string');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator->allowEmpty('discount');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}