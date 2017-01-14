<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class AdminForm extends Form
{
    /**
     * Basic Structure of the Schema
     *
     * @param Schema $schema The standard schema to be modified.
     *
     * @return Schema $schema
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('link', 'string');
    }

    /**
     * Function to Validate the Form
     *
     * @param Validator $validator The basic Validation to be extended.
     *
     * @return Validator $validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->notEmpty('link');

        return $validator;
    }
}
