<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PasswordStates Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\PasswordState get($primaryKey, $options = [])
 * @method \App\Model\Entity\PasswordState newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PasswordState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PasswordState|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PasswordState saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PasswordState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PasswordState[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PasswordState findOrCreate($search, callable $callback = null, $options = [])
 */
class PasswordStatesTable extends Table
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

        $this->setTable('password_states');
        $this->setDisplayField('password_state');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'password_state_id',
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
            ->scalar('password_state')
            ->maxLength('password_state', 255)
            ->requirePresence('password_state', 'create')
            ->allowEmptyString('password_state', false);

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        $validator
            ->boolean('expired')
            ->requirePresence('expired', 'create')
            ->allowEmptyString('expired', false);

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
        $rules->add($rules->isUnique(['password_state']));

        return $rules;
    }
}
