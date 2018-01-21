<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class PasswordForm extends Form
{
    /**
     * Build the Schema of the form.
     *
     * @param Schema $schema The basic Schema to be Extended
     *
     * @return Schema $schema
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
     * @param Validator $validator The basic Validation to be extended.
     *
     * @return Validator $validator
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
