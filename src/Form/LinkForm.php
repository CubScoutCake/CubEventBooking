<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class LinkForm extends Form
{
    /**
     * Build the Schema of the form.
     *
     * @param \Cake\Form\Schema $schema The basic Schema to be Extended
     *
     * @return \Cake\Form\Schema $schema
     */
    protected function _buildSchema(Schema $schema)
    {
        $schema->addField('osm_email', 'string')
            ->addField('osm_password', 'string');

        return $schema;
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
            ->add('osm_email', 'valid', ['rule' => 'email'])
            ->requirePresence('osm_email', 'create')
            ->notEmpty('osm_email');

        $validator
            //->add('osm_password', 'valid', ['rule' => 'string'])
            ->requirePresence('osm_password', 'create')
            ->notEmpty('osm_password');

        return $validator;
    }
}
