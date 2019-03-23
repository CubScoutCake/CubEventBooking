<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parameters Model
 *
 * @property \App\Model\Table\ParameterSetsTable|\Cake\ORM\Association\BelongsTo $ParameterSets
 * @property \App\Model\Table\LogisticsTable|\Cake\ORM\Association\HasMany $Logistics
 * @property \App\Model\Table\ParamsTable|\Cake\ORM\Association\HasMany $Params
 *
 * @method \App\Model\Entity\Parameter get($primaryKey, $options = [])
 * @method \App\Model\Entity\Parameter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Parameter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Parameter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parameter|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parameter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Parameter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Parameter findOrCreate($search, callable $callback = null, $options = [])
 */
class ParametersTable extends Table
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

        $this->setTable('parameters');
        $this->setDisplayField('parameter');
        $this->setPrimaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);

        $this->belongsTo('ParameterSets', [
            'foreignKey' => 'set_id'
        ]);
        $this->hasMany('Logistics', [
            'foreignKey' => 'parameter_id'
        ]);
        $this->hasMany('Params', [
            'foreignKey' => 'parameter_id'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('parameter')
            ->maxLength('parameter', 45)
            ->requirePresence('parameter')
            ->allowEmptyString('parameter', false);

        $validator
            ->scalar('constant')
            ->maxLength('constant', 255)
            ->allowEmptyString('constant', false);

        $validator
            ->boolean('limited')
            ->requirePresence('limited', 'create')
            ->allowEmptyString('limited', false);

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
        $rules->add($rules->existsIn(['set_id'], 'ParameterSets'));

        return $rules;
    }
}
