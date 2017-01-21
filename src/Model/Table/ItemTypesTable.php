<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $InvoiceItems
 * @property \Cake\ORM\Association\HasMany $Prices
 *
 * @method \App\Model\Entity\ItemType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemType findOrCreate($search, callable $callback = null, $options = [])
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

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id'
        ]);
        $this->hasMany('InvoiceItems', [
            'foreignKey' => 'item_type_id'
        ]);
        $this->hasMany('Prices', [
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('item_type', 'create')
            ->notEmpty('item_type');

        $validator
            ->boolean('minor')
            ->requirePresence('minor', 'create')
            ->notEmpty('minor');

        $validator
            ->boolean('cancelled')
            ->allowEmpty('cancelled');

        $validator
            ->boolean('available')
            ->allowEmpty('available');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
