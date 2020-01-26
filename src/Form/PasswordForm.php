<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class PasswordForm extends Form
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
        $schema->addField('newpw', ['type' => 'string'])
            ->addField('confirm', ['type' => 'string'])
            ->addField('postcode', ['type' => 'string']);

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
        $validator->requirePresence('newpw')
            ->notEmpty('newpw');

        $validator->requirePresence('confirm')
            ->notEmpty('confirm');

        $validator->requirePresence('postcode')
            ->notEmpty('postcode');

        return $validator;
    }
}
