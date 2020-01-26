<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class ResetForm extends Form
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
        $schema->addField('scoutgroup', 'integer')
            ->addField('email', 'varchar');

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
        $validator->requirePresence('scoutgroup');

        $validator->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email')
            ->notEmpty('email');

        return $validator;
    }
}
