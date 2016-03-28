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
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->add('dateofbirth', 'valid', ['rule' => 'date'])
            ->requirePresence('dateofbirth', 'create')
            ->notEmpty('dateofbirth');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');;

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
            ->add('osm_generated', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('osm_generated');

        $validator
            ->add('osm_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('osm_id');

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
        $rules->add($rules->isUnique(['osm_id']));
        return $rules;
    }

    public function isOwnedBy($attendeeId, $userId)
    {
        return $this->exists(['id' => $attendeeId, 'user_id' => $userId]);
    }
}
