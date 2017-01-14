<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class DirectForm extends Form
{
    /**
     * Basic schema definition
     *
     * @param Schema $schema The Schema to be extended.
     *
     * @return Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        $schema->addField('id', 'int');

        $schema->addField('controller', 'int');

        return $schema;
    }

    /**
     * Validator for validating the entered Data.
     *
     * @param Validator $validator The Validation Rules to be modified.
     *
     * @return Validator
     */
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
}
