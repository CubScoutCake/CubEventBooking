<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class DiscountForm extends Form
{
    /**
     * Specify the Schema of this Form.
     *
     * @param \Cake\Form\Schema $schema The Schema to be built
     *
     * @return \Cake\Form\Schema $schema
     */
    protected function _buildSchema(Schema $schema)
    {
        $schema->addField('discount', 'string');

        return $schema;
    }

    /**
     * Validation of the discount default.
     *
     * @param \Cake\Validation\Validator $validator The basic validation to be extended.
     *
     * @return \Cake\Validation\Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $validator->allowEmpty('discount');

        return $validator;
    }

    /**
     * Application of the Discount Array.
     *
     * @param array $data The Data to feed the form.
     *
     * @return bool;
     */
    protected function _execute(array $data)
    {
        return true;
    }
}
