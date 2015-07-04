<?php
namespace App\Model\Table;

use App\Model\Entity\Application;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Scoutgroups
 * @property \Cake\ORM\Association\BelongsToMany $Attendees
 */
class ApplicationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('applications');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Scoutgroups', [
            'foreignKey' => 'scoutgroup_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Attendees', [
            'foreignKey' => 'application_id',
            'targetForeignKey' => 'attendee_id',
            'joinTable' => 'applications_attendees'
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
            ->allowEmpty('section');
            
        $validator
            ->add('permitholder', 'valid', ['rule' => 'numeric'])
            ->requirePresence('permitholder', 'create')
            ->notEmpty('permitholder');
            
        $validator
            ->add('modification', 'valid', ['rule' => 'numeric'])
            ->requirePresence('modification', 'create')
            ->notEmpty('modification');
            
        $validator
            ->requirePresence('eventname', 'create')
            ->notEmpty('eventname');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['scoutgroup_id'], 'Scoutgroups'));
        return $rules;
    }

    public function isOwnedBy($applicatonId, $userId)
    {
        return $this->exists(['id' => $applicationId, 'user_id' => $userId]);
    }
}
