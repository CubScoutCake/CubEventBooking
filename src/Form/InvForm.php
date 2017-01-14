<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class InvForm extends Form
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
        $schema->addField('cubs', 'integer')
            ->addField('yls', 'integer')
            ->addField('leaders', 'integer');

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
        $validator->allowEmpty('cubs');

        $validator->allowEmpty('yls');

        $validator->allowEmpty('leaders');

        return $validator;
    }
}
