<?php
namespace App\Model\Table;

use App\Model\Entity\Itemtype;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Itemtypes Model
 *
 * @property \Cake\ORM\Association\HasMany $InvoiceItems
 */
class ItemtypesTable extends Table
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

        $this->table('itemtypes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('InvoiceItems', [
            'foreignKey' => 'itemtype_id'
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
            ->requirePresence('itemtype', 'create')
            ->notEmpty('itemtype');

        $validator
            ->add('roletype', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('roletype');

        $validator
            ->add('minor', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('minor');

        return $validator;
    }
}
