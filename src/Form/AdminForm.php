<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class AdminForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('link', 'string');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->notEmpty('link');

        return $validator;
    }

    protected function _execute(array $data)
    {

    }
}