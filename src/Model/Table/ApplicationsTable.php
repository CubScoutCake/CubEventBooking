<?php
namespace App\Model\Table;

use App\Model\Entity\Application;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Applications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Sections
 * @property \Cake\ORM\Association\BelongsTo $Events
 * @property \Cake\ORM\Association\HasOne $Invoices
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

        $this->setTable('applications');
        $this->setDisplayField('display_code');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                    ]
                ]
            ]);

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);

        $this->addBehavior('SectionAuth');

        $this->addBehavior('CounterCache', [
            'Events' => [
                'cc_apps'
            ]
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasOne('Invoices', [
                'foreignKey' => 'application_id',
            ])
            ->setDependent(true)
            ->setCascadeCallbacks(true);

        $this->hasMany('LogisticItems', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'application_id'
        ]);
        $this->belongsToMany('Attendees', [
            'through' => 'ApplicationsAttendees',
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
            ->notEmpty('permit_holder');

        $validator
            ->notEmpty('team_leader');

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
        $rules->add($rules->existsIn(['sections_id'], 'Sections'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }

    /**
     * Ownership test function for Authentication.
     *
     * @param int $applicationId The Application Id to be checked.
     * @param int $userId The asserted User.
     * @return bool
     */
    public function isOwnedBy($applicationId, $userId)
    {
        return $this->exists(['id' => $applicationId, 'user_id' => $userId]);
    }

    /**
     * Finds the applications owned by the user.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options An array containing the user to be searched for.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findOwnedBy($query, $options)
    {
        $userId = $options['userId'];

        return $query->where(['Applications.user_id' => $userId]);
    }

    /**
     * Finds the applications that are not for an archived event.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findUnarchived($query)
    {
        return $query->contain('Events')->where(['Events.live' => true]);
    }

    /**
     * Finds the attendees, which are Cubs on the Application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findCubs($query)
    {
        $query = $query->matching(
            'Attendees.Roles',
            function ($q) {
                return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => true, 'Roles.id' => 1]);
            }
        );

        return $query;
    }

    /**
     * Finds the attendees, which are Young Leaders on the Application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findYoungLeaders($query)
    {
        $query = $query->matching(
            'Attendees.Roles',
            function ($q) {
                return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => true, 'Roles.id <>' => 1]);
            }
        );

        return $query;
    }

    /**
     * Finds the attendees, which are Adult Leaders on the Application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findLeaders($query)
    {
        $query = $query->matching(
            'Attendees.Roles',
            function ($q) {
                return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => false]);
            }
        );

        return $query;
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
