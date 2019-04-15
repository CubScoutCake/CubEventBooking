<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ItemTypes
 * @property \Cake\ORM\Association\BelongsTo $Events
 *
 * @method \App\Model\Entity\Price get($primaryKey, $options = [])
 * @method \App\Model\Entity\Price newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Price[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Price|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Price patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Price[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Price findOrCreate($search, callable $callback = null, $options = [])
 */
class PricesTable extends Table
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

        $this->setTable('prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('CounterCache', [
            'Events' => ['cc_prices'],
        ]);

        $this->belongsTo('ItemTypes', [
            'foreignKey' => 'item_type_id'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER'
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
            ->integer('max_number')
            ->allowEmpty('max_number');

        $validator
            ->numeric('value')
            ->allowEmpty('value');

        $validator
            ->allowEmpty('description');

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
        $rules->add($rules->existsIn(['item_type_id'], 'ItemTypes'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }

    /**
     * Finder to locate Parent Accounts
     *
     * @param Query $query the Query to be modified.
     *
     * @return Query
     */
    public function findDeposits($query)
    {
        return $query
            ->contain('ItemTypes')
            ->where(['ItemTypes.deposit' => true]);
    }
}
