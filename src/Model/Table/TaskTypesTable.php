<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaskTypes Model
 *
 * @property \App\Model\Table\TasksTable|\Cake\ORM\Association\HasMany $Tasks
 *
 * @method \App\Model\Entity\TaskType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaskType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaskType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaskType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaskType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaskType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaskType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaskType findOrCreate($search, callable $callback = null, $options = [])
 */
class TaskTypesTable extends Table
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

        $this->setTable('task_types');
        $this->setDisplayField('task_type');
        $this->setPrimaryKey('id');

        $this->hasMany('Tasks', [
            'foreignKey' => 'task_type_id'
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
            ->scalar('task_type')
            ->maxLength('task_type', 255)
            ->requirePresence('task_type', 'create')
            ->allowEmptyString('task_type', false);

        $validator
            ->boolean('shared_type')
            ->requirePresence('shared_type', 'create')
            ->allowEmptyString('shared_type', false);

        $validator
            ->scalar('type_icon')
            ->maxLength('type_icon', 15)
            ->requirePresence('type_icon', 'create')
            ->allowEmptyString('type_icon', false);

        $validator
            ->scalar('type_code')
            ->maxLength('type_code', 3)
            ->requirePresence('type_code', 'create')
            ->allowEmptyString('type_code', false);

        $validator
            ->scalar('task_requirement')
            ->requirePresence('task_requirement', 'create')
            ->allowEmptyString('task_requirement', false);

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
        $rules->add($rules->isUnique(['task_type']));

        return $rules;
    }
}
