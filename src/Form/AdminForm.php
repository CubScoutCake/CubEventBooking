<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class AdminForm extends Form
{
    /**
     * Basic Structure of the Schema
     *
     * @param \Cake\Form\Schema $schema The standard schema to be modified.
     *
     * @return \Cake\Form\Schema $schema
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('q', 'string');
    }

    /**
     * Function to Validate the Form
     *
     * @param \Cake\Validation\Validator $validator The basic Validation to be extended.
     *
     * @return \Cake\Validation\Validator $validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->notEmpty('q');

        return $validator;
    }
}
