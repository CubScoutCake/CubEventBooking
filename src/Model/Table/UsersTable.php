<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $Scoutgroups
 * @property \Cake\ORM\Association\HasMany $Applications
 * @property \Cake\ORM\Association\HasMany $Attendees
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Scoutgroups', [
            'foreignKey' => 'scoutgroup_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Attendees', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');
            
        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');
            
        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');
            
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
            
        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');
            
        $validator
            ->requirePresence('address_1', 'create')
            ->notEmpty('address_1');
            
        $validator
            ->allowEmpty('address_2');
            
        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');
            
        $validator
            ->requirePresence('county', 'create')
            ->notEmpty('county');
            
        $validator
            ->requirePresence('postcode', 'create')
            ->notEmpty('postcode');
            
        $validator
            ->requirePresence('section', 'create')
            ->notEmpty('section');
            
        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->notEmpty('authrole', 'A role is required')
            ->add('authrole', 'inList', [
                'rule' => ['inList', ['admin', 'author','user']],
                'message' => 'Please enter a valid role'
            ]);

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['scoutgroup_id'], 'Scoutgroups'));
        return $rules;
    }
}
