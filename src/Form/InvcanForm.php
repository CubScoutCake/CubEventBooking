<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class InvcanForm extends Form
{
    /**
     * Build schema for the form.
     *
     * @param \Cake\Form\Schema $schema The basic schema to be extended.
     *
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        $schema->addField('cubs', 'integer')
            ->addField('yls', 'integer')
            ->addField('leaders', 'integer')
            ->addField('cancelled_cubs', 'integer')
            ->addField('cancelled_yls', 'integer')
            ->addField('cancelled_leaders', 'integer');

        return $schema;
    }

    /**
     * Build Validator array.
     *
     * @param \Cake\Validation\Validator $validator The Basic Validator to be Extended.
     *
     * @return \Cake\Validation\Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $validator->allowEmpty('cubs');

        $validator->allowEmpty('yls');

        $validator->allowEmpty('leaders');

        $validator->allowEmpty('cancelled_cubs');

        $validator->allowEmpty('cancelled_yls');

        $validator->allowEmpty('cancelled_leaders');

        return $validator;
    }
}
