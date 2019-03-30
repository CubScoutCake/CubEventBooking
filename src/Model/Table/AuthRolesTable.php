<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuthRoles Model
 *
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\AuthRole get($primaryKey, $options = [])
 * @method \App\Model\Entity\AuthRole newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AuthRole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AuthRole|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AuthRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AuthRole[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AuthRole findOrCreate($search, callable $callback = null)
 */
class AuthRolesTable extends Table
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

        $this->setTable('auth_roles');
        $this->setDisplayField('auth_role');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'auth_role_id'
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
            ->requirePresence('auth_role', 'create')
            ->allowEmptyString('auth_role', false)
            ->add('auth_role', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('admin_access')
            ->allowEmptyString('admin_access');

        $validator
            ->boolean('champion_access')
            ->allowEmptyString('champion_access');

        $validator
            ->boolean('super_user')
            ->allowEmptyString('super_user');

        $validator
            ->integer('auth')
            ->requirePresence('auth', false)
            ->allowEmptyString('auth');

        $validator
            ->boolean('parent_access')
            ->allowEmptyString('parent_access');

        $validator
            ->boolean('user_access')
            ->allowEmptyString('user_access');

        $validator
            ->boolean('section_limited')
            ->allowEmptyString('section_limited');

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
        $rules->add($rules->isUnique(['auth_role']));

        return $rules;
    }

    /**
     * Hashes the password before save
     *
     * @param \Cake\Event\Event $event The event trigger.
     *
     * @return true
     */
    public function beforeSave($event)
    {
        /** @var \App\Model\Entity\AuthRole $entity */
        $entity = $event->getData('entity');

        $entity->set('auth', $entity->auth_value);

        return true;
    }
}
