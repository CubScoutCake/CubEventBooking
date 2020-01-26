<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * AttNumber Form.
 */
class AttNumberForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        $schema->addField('section', 'integer')
            ->addField('non_section', 'integer')
            ->addField('leaders', 'integer');

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
        $validator->requirePresence('section', 'create')
            ->notEmpty('section');

        return $validator;
    }

    /**
     * Application of the Discount Array.
     *
     * @param array $data The Data to feed the form.
     *
     * @return bool
     */
    protected function _execute(array $data)
    {
        return true;
    }
}
