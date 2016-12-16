<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class SectionForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('osm_section', 'int');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->add('osm_section', 'valid', ['rule' => 'numeric'])
            ->requirePresence('osm_section', 'create')
            ->notEmpty('osm_section');

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}
