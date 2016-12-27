<?php
namespace App\Model\Table;

use App\Model\Entity\Attendee;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attendees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Scoutgroups
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsToMany $Applications
 * @property \Cake\ORM\Association\BelongsToMany $Allergies
 */
class AttendeesTable extends Table
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

        $this->table('attendees');
        $this->displayField('full_name');
        $this->primaryKey('id');

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

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Scoutgroups', [
            'foreignKey' => 'scoutgroup_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Applications', [
            'foreignKey' => 'attendee_id',
            'targetForeignKey' => 'application_id',
            'joinTable' => 'applications_attendees'
        ]);
        $this->belongsToMany('Allergies', [
            'foreignKey' => 'attendee_id',
            'targetForeignKey' => 'allergy_id',
            'joinTable' => 'attendees_allergies'
        ]);

        // Adding Counter Caches

        /*$this->addBehavior('CounterCache', [
            'Applications' => ['cc_att_total']
        ]);*/
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
            ->notEmpty('firstname');

        $validator
            ->notEmpty('lastname');

        $validator
            ->add('dateofbirth', 'valid', ['rule' => 'date'])
            ->notEmpty('dateofbirth');

        $validator
            ->notEmpty('phone');

        $validator
            ->allowEmpty('phone2');

        $validator
            ->allowEmpty('address_1');

        $validator
            ->allowEmpty('address_2');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('county');

        $validator
            ->allowEmpty('postcode');

        $validator
            ->add('nightsawaypermit', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('nightsawaypermit');

        $validator
            ->add('vegetarian', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('vegetarian');

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
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

    /**
     * Ownership test function for Authentication.
     *
     * @param int $attendeeId The Attendee Id to be checked.
     * @param int $userId The asserted User.
     * @return bool
     */
    public function isOwnedBy($attendeeId, $userId)
    {
        return $this->exists(['id' => $attendeeId, 'user_id' => $userId]);
    }

    /**
     * Finds the number of applications the attendee is on.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findCountIncluded($query)
    {
        return $query->select(['total_applications' => $query->func()->count('x.application_id')])
            ->join([
                'x' => [
                    'table' => 'applications_attendees',
                    'type' => 'LEFT',
                    'conditions' => 'x.attendee_id = Attendees.id',
                ]
            ])
            ->group(['Attendees.id'])
            ->autoFields(true);
    }

    /**
     * Finds OSM attendees.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findOsm($query)
    {
        return $query->where(['osm_id IS NOT' => false]);
    }

    /**
     * Filters the attendees to those which haven't been attached to an application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findUnattached($query)
    {
        return $query->select(['total_applications' => $query->func()->count('x.application_id')])
            ->join([
                'x' => [
                    'table' => 'applications_attendees',
                    'type' => 'LEFT',
                    'conditions' => 'x.attendee_id = Attendees.id',
                ]
            ])
            ->group(['Attendees.id'])
            ->having(['total_applications <' => 1])
            ->autoFields(true);
    }
}
