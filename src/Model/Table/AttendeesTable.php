<?php
namespace App\Model\Table;

use App\Model\Entity\Attendee;
use Cake\Database\Expression\QueryExpression;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attendees Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\BelongsToMany $Applications
 * @property \App\Model\Table\AllergiesTable|\Cake\ORM\Association\BelongsToMany $Allergies
 * @property \App\Model\Table\AllergiesTable|\Cake\ORM\Association\BelongsToMany $DietaryRestrictions
 * @property \App\Model\Table\AllergiesTable|\Cake\ORM\Association\BelongsToMany $MedicalIssues
 *
 * @method \App\Model\Entity\Attendee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Attendee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Attendee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attendee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Attendee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Attendee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attendee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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

        $this->setTable('attendees');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('SectionAuth');

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

        $this->addBehavior('CounterCache', [
            'Sections' => [
                'cc_atts'
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
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Applications', [
            'through' => 'ApplicationsAttendees',
        ]);
        $this->belongsToMany('Allergies', [
            'through' => 'AttendeesAllergies',
        ]);
        $this->belongsTo('DietaryRestrictions', [
            'className' => 'Allergies',
            'through' => 'AttendeesAllergies',
            'property' => 'dietary_restrictions',
            'conditions' => ['DietaryRestrictions.is_dietary' => true],
        ]);
        $this->belongsTo('MedicalIssues', [
            'className' => 'Allergies',
            'through' => 'AttendeesAllergies',
            'property' => 'medical_issues',
            'conditions' => ['MedicalIssues.is_medical' => true],
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 255)
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 255)
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->date('dateofbirth')
            ->allowEmptyString('dateofbirth');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 12)
            ->allowEmpty('phone');

        $validator
            ->scalar('phone2')
            ->maxLength('phone2', 12)
            ->allowEmpty('phone2');

        $validator
            ->scalar('address_1')
            ->maxLength('address_1', 255)
            ->allowEmpty('address_1');

        $validator
            ->scalar('address_2')
            ->maxLength('address_2', 255)
            ->allowEmpty('address_2');

        $validator
            ->scalar('city')
            ->maxLength('city', 125)
            ->allowEmpty('city');

        $validator
            ->scalar('county')
            ->maxLength('county', 125)
            ->allowEmpty('county');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 8)
            ->allowEmpty('postcode');

        $validator
            ->boolean('nightsawaypermit')
            ->allowEmpty('nightsawaypermit');

        $validator
            ->boolean('vegetarian')
            ->allowEmpty('vegetarian');

        $validator
            ->boolean('osm_generated')
            ->allowEmpty('osm_generated');

        $validator
            ->dateTime('osm_sync_date')
            ->allowEmpty('osm_sync_date');

        $validator
            ->boolean('user_attendee')
            ->allowEmpty('user_attendee');

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
        $rules->add($rules->existsIn(['section_id'], 'Sections'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        $rules->add($rules->isUnique(['osm_id', 'user_id'], 'This attendee already exists'));
        $rules->add($rules->isUnique(['firstname', 'lastname', 'user_id'], 'This attendee already exists'));

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
     * Finds the applications owned by the user.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options An array containing the user to be searched for.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findOwnedBy($query, $options)
    {
        $userId = $options['userId'];

        return $query->where(['Attendees.user_id' => $userId]);
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
     *
     * @return \Cake\ORM\Query The modified query.
     */
    public function findOsm($query)
    {
        return $query->where(function (QueryExpression $exp, Query $q) {
            return $exp->isNotNull('osm_id');
        });
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
            ->enableAutoFields(true);
    }

    /**
     * Case Rules - Applied before Rules
     *
     * @param \Cake\Event\Event $event The event being processed.
     * @param \App\Model\Entity\Attendee $entity The Attendee being Processed
     * @return bool
     */
    public function beforeRules(Event $event, $entity)
    {
        $newEntity = $this->checkDuplicate($entity);

        if (!$newEntity->isNew()) {
            $entity->id = $newEntity->id;
            $entity->isNew(false);
        }

        foreach ($entity->getDirty() as $changed) {
            $entity = $entity->set($changed, $newEntity->get($changed));
        }

        //$entity = $this->changeCase($entity);

        return true;
    }

    /**
     * @param Event $event The Event Lifecycle
     * @param array $data The Data Present
     *
     * @return void
     */
    public function beforeMarshal($event, $data)
    {
        $data = $this->changeArrayCase($data);
    }

    /**
     * Check for Duplicate Attendee
     *
     * @param Attendee $entity The Entity for DeDuplication
     *
     * @return Attendee
     */
    public function checkDuplicate($entity)
    {
        $original = $this->find('all')->where([
            'user_id' => $entity->user_id,
            'OR' => [
                [
                    'firstname' => $entity->firstname,
                    'lastname' => $entity->lastname,
                ],
                [
                    'osm_id' => $entity->osm_id,
                    'osm_generated' => true,
                ],
            ]
        ]);

        $countOriginal = $original->count();

        if ($countOriginal > 0) {
            $originalEnt = $original->first();

            if ($originalEnt->get('id') == $entity->get('id') && !$entity->isNew()) {
                return $entity;
            }

            $changedValues = $entity->getDirty();

            if (count($changedValues) > 0) {
                $newData = [];

                foreach ($changedValues as $changed_value) {
                    $value = $entity->get($changed_value);
                    if (!empty($value)) {
                        $newData = $newData[$changed_value] = $value;
                    }
                }

                if (count($newData) > 0 && is_array($newData) && !is_null($newData)) {
                    $originalEnt = $this->patchEntity($originalEnt, $newData);
                }
            }

            return $originalEnt;
        }

        return $entity;
    }

    /**
     * @var array The Array for Uppercase Conversion
     */
    public $upperCase = ['postcode'];

    /**
     * @var array The Array for Title Case Conversion
     */
    public $initCase = ['firstname', 'lastname', 'address_1', 'address_2', 'city', 'county'];

    /**
     * @param array $array The Array for Case Normalisation
     *
     * @return array
     */
    public function changeArrayCase($array)
    {
        foreach ($this->initCase as $initValue) {
            if (key_exists($initValue, $array)) {
                $array[$initValue] = ucwords(strtolower($array[$initValue]));
            }
        }

        foreach ($this->upperCase as $upperValue) {
            if (key_exists($upperValue, $array)) {
                $array[$upperValue] = strtoupper($array[$upperValue]);
            }
        }

        return $array;
    }

    /**
     * @param Attendee $entity The Attendee Entity to be Case Fixed
     *
     * @return Attendee
     */
    public function changeCase($entity)
    {
        foreach ($this->initCase as $initValue) {
            $entity = $entity->set($initValue, ucwords(strtolower($entity->get($initValue))));
        }

        foreach ($this->upperCase as $upperValue) {
            $entity = $entity->set($upperValue, strtoupper($entity->get($upperValue)));
        }

        return $entity;
    }

    /* Phone Change Code
     * $phone1 = $attendee->phone;
            $phone2 = $attendee->phone2;

            $phone1 = str_replace(' ', '', $phone1);
            $phone1 = str_replace('-', '', $phone1);
            $phone1 = str_replace('/', '', $phone1);
            $phone1 = substr($phone1, 0, 5) . ' ' . substr($phone1, 5);

            if (!empty($phone2)) {
                $phone2 = str_replace(' ', '', $phone2);
                $phone2 = str_replace('-', '', $phone2);
                $phone2 = str_replace('/', '', $phone2);
                $phone2 = substr($phone2, 0, 5) . ' ' . substr($phone2, 5);
            }
     */

    /**
     * Merge Function
     *
     * @param int $attendeeId The ID for the Attendee to be merged.
     *
     * @return int;
     */
    public function removeDuplicate($attendeeId)
    {
        $mrgAttendee = $this->get($attendeeId);

        $options = [
            //'fields' => [
            //    'user_id',
            //    'role_id',
            //    'firstname',
            //    'lastname',
            //    'dateofbirth',
            //    'osm_id',
            //    'osm_sync_date',
            //    'created',
            //    'modified'
            //],
            'conditions' => [
                'user_id' => $mrgAttendee->user_id,
                'firstname' => $mrgAttendee->firstname,
                'lastname' => $mrgAttendee->lastname,
                'role_id' => $mrgAttendee->role_id,
            ],
        ];
        $allAttendees = $this->find('all', $options);
        $count = $allAttendees->count();

        $osmId = $this->find('all', $options)->find('all', [
            'fields' => [
                'osm_id',
                'osm_sync_date',
                'modified'],
            'conditions' => [
                'osm_id IS NOT' => null
            ]
        ])->order([
            'osm_sync_date' => 'DESC',
            'modified' => 'DESC'
        ])->first();

        $address = $this->find('all', $options)->find('all', [
            'fields' => [
                'address_1',
                'address_2',
                'city',
                'county',
                'postcode',
            ],
            'conditions' => [
                'address_1 IS NOT' => ''
            ]
        ])->order([
            'modified' => 'DESC'
        ])->first();

        $userAttendee = $this->find('all', $options)->find('all', [
            'fields' => [
                'user_attendee'
            ],
            'conditions' => [
                'user_attendee' => true
            ]
        ])->count();

        if ($userAttendee > 0) {
            $mrgAttendee = $this->patchEntity($mrgAttendee, ['user_attendee' => true], ['validate' => false]);
        }

        $finalData = [
            'osm_id' => $osmId['osm_id'],
            'osm_sync_date' => $osmId['osm_sync_date'],
            'address_1' => $address['address_1'],
            'address_2' => $address['address_2'],
            'city' => $address['city'],
            'county' => $address['county'],
            'postcode' => $address['postcode'],
        ];

        $mrgAttendee = $this->patchEntity($mrgAttendee, $finalData);

        if ($this->save($mrgAttendee)) {
            return $count;
        }
        Log::info('There was an error merging the attendee #' . $attendeeId);

        return 0;
    }

    /**
     * Function to create an attendee for Reservation with slimline Data
     *
     * @param array $attendeeData Attendee Request data
     * @param int $userId The User ID
     *
     * @return bool|Attendee
     */
    public function createReservationAttendee($attendeeData, $userId)
    {
        // Start Creating Attendee
        $attendeeData['user_id'] = $userId;

        // Find Cub Role
        $cubRole = $this->Roles->findOrCreate([
            'role' => 'Cub Scout',
            'invested' => true,
            'minor' => true,
            'automated' => false,
            'short_role' => 'Cub',
        ]);
        $attendeeData['role_id'] = $cubRole->id;

        $attendee = $this->newEntity($attendeeData);

        /** @var \App\Model\Entity\Attendee $attendee */
        return $this->save($attendee);
    }
}
