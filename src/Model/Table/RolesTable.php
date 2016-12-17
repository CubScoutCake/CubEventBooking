<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \Cake\ORM\Association\HasMany $Attendees
 * @property \Cake\ORM\Association\HasMany $Users
 */
class RolesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('roles');
        $this->displayField('role');
        $this->primaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);
        
        $this->hasMany('Attendees', [
            'foreignKey' => 'role_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'role_id'
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
            ->requirePresence('role', 'create')
            ->notEmpty('role');
            
        $validator
            ->add('invested', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('invested');
            
        $validator
            ->add('minor', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('minor');

        $validator
            ->boolean('automated')
            ->allowEmpty('automated');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }

    /**
     * Process the function parameter comments.
     *
     * @param array $query    The query being modified.
     * @return array
     */
    public function findNonAuto($query)
    {
        return $query->where(['Roles.automated' => false]);
    }

    /**
     * Process the function parameter comments.
     *
     * @param array $query    The query being modified.
     * @return array
     */
    public function findAdults($query)
    {
        return $query->where(['Roles.minor' => false]);
    }

    /**
     * Process the function parameter comments.
     *
     * @param array $query    The query being modified.
     * @return array
     */
    public function findLeaders($query)
    {
        return $query->where(['Roles.minor' => false, 'Roles.invested' => true]);
    }

    /**
     * Process the function parameter comments.
     *
     * @param array $query    The query being modified.
     * @return array
     */
    public function findMinors($query)
    {
        return $query->where(['Roles.minor' => true]);
    }
}
