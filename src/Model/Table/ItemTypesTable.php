<?php
namespace App\Model\Table;

use App\Model\Entity\Itemtype;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $InvoiceItems
 */
class ItemTypesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('item_types');
        $this->displayField('item_type');
        $this->primaryKey('id');

        $this->hasMany('InvoiceItems', [
            'foreignKey' => 'item_type_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('item_type', 'create')
            ->notEmpty('item_type');

        $validator
            ->add('role_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('role_id');

        $validator
            ->add('minor', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('minor');

        $validator
            ->add('cancelled', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('cancelled');

        return $validator;
    }
}
