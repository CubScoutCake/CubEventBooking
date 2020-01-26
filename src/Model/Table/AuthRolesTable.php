<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuthRoles Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
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
            'foreignKey' => 'auth_role_id',
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

    /**
     * Validate or Create an Equivalent Parent Auth Role
     *
     * @param \App\Model\Entity\AuthRole|null $authRole The AuthRole to be Parent checked
     *
     * @return int
     */
    public function parentAuthRole($authRole = null)
    {
        if (is_null($authRole)) {
            $parentFind = $this->find('all')->where(['auth' => 1, 'parent_access' => true]);

            if ($parentFind->count() > 0) {
                return $parentFind->firstOrFail()->id;
            }

            $newAuthRole = $this->newEntity([
                'auth_role' => 'Parent',
                'admin_access' => false,
                'champion_access' => false,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => true,
                'user_access' => false,
                'section_limited' => true,
            ]);
            $newAuthRole = $this->save($newAuthRole);

            return $newAuthRole->id;
        }

        $authArray = $authRole->toArray();

        if (!(strpos($authRole->auth_role, 'Parent') !== false)) {
            $authArray['auth_role'] .= ' Parent';
        }

        if (!$authArray['parent_access']) {
            $authArray['parent_access'] = true;
            unset($authArray['id']);
        }

        unset($authArray['auth_value']);
        $newAuthQuery = $this->find()->where($authArray);
        if ($newAuthQuery->count() > 0) {
            return $newAuthQuery->first()->id;
        }

        $newAuthRole = $this->newEntity($authArray);
        $newAuthRole = $this->save($newAuthRole);

        return $newAuthRole->id;
    }
}
