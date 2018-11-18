<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logistics Model
 *
 * @property \App\Model\Table\ParametersTable|\Cake\ORM\Association\BelongsTo $Parameters
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\LogisticItemsTable|\Cake\ORM\Association\HasMany $LogisticItems
 *
 * @method \App\Model\Entity\Logistic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Logistic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Logistic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Logistic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistic|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Logistic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Logistic findOrCreate($search, callable $callback = null, $options = [])
 */
class LogisticsTable extends Table
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

        $this->setTable('logistics');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);

        $this->belongsTo('Parameters', [
            'foreignKey' => 'parameter_id'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('LogisticItems', [
            'foreignKey' => 'logistic_id'
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
            ->scalar('header')
            ->maxLength('header', 45)
            ->allowEmpty('header');

        $validator
            ->scalar('text')
            ->maxLength('text', 999)
            ->allowEmpty('text');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

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
        $rules->add($rules->existsIn(['parameter_id'], 'Parameters'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }
}
