<?php
namespace App\Model\Table;

use App\Model\Entity\Application;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Applications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Scoutgroups
 * @property \Cake\ORM\Association\BelongsTo $Events
 * @property \Cake\ORM\Association\HasMany $Invoices
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
        parent::initialize($config);

        $this->table('applications');
        $this->displayField('display_code');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                    ]
                ]
            ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Scoutgroups', [
            'foreignKey' => 'scoutgroup_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('LogisticItems', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'application_id'
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
            ->allowEmpty('modification');

        $validator
            ->requirePresence('permitholder', 'create')
            ->notEmpty('permitholder');
            
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
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        return $rules;
    }

    public function isOwnedBy($applicationId, $userId)
    {
        return $this->exists(['id' => $applicationId, 'user_id' => $userId]);
    }

    /*public function isChampedBy($applicationId, $userId)
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');
        $users = TableRegistry::get('Users');

        $user = $users->get($userId, ['contain' => 'Scoutgroups'])->Scoutgroup->district_id;
        $groups = $scoutgroups->find('list', ['conditions' => ['district' => $user]]);

        return $this->existsIn(['id' => $applicationId, 'Scoutgroup' => $userId]);
    }*/
}
