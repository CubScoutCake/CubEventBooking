<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reservations Model
 *
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AttendeesTable|\Cake\ORM\Association\BelongsTo $Attendees
 * @property \App\Model\Table\ReservationStatusesTable|\Cake\ORM\Association\BelongsTo $ReservationStatuses
 * @property \App\Model\Table\InvoicesTable|\Cake\ORM\Association\HasOne $Invoices
 * @property \App\Model\Table\LogisticItemsTable|\Cake\ORM\Association\HasMany $LogisticItems
 *
 * @method \App\Model\Entity\Reservation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reservation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reservation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reservation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reservation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reservation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReservationsTable extends Table
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

        $this->setTable('reservations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                ]
            ]
        ]);

        $this->addBehavior('CounterCache', [
            'Events' => [
                'cc_res' => [
                    'finder' => 'active'
                ]
            ],
        ]);

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Attendees', [
            'foreignKey' => 'attendee_id',
        ]);
        $this->belongsTo('ReservationStatuses', [
            'foreignKey' => 'reservation_status_id',
        ]);
        $this->hasOne('Invoices', [
            'foreignKey' => 'reservation_id',
        ])
             ->setDependent(true)
             ->setCascadeCallbacks(true);

        $this->hasMany('LogisticItems', [
            'foreignKey' => 'reservation_id'
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
            ->allowEmptyString('user_id', false)
            ->requirePresence('user_id');

        $validator
            ->allowEmptyString('attendee_id', false)
            ->requirePresence('attendee_id');

        $validator
            ->allowEmptyString('event_id', false)
            ->requirePresence('event_id');

        $validator
            ->allowEmptyString('reservation_status_id', false)
            ->requirePresence('reservation_status_id');

        $validator
            ->dateTime('expires')
            ->allowEmptyDateTime('expires');

        $validator
            ->scalar('reservation_code')
            ->maxLength('reservation_code', 3)
            ->allowEmptyString('reservation_code');

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
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['attendee_id'], 'Attendees'));
        $rules->add($rules->existsIn(['reservation_status_id'], 'ReservationStatuses'));

        return $rules;
    }

    /**
     * Ownership test function for Authentication.
     *
     * @param int $reservationId The Application Id to be checked.
     * @param int $userId The asserted User.
     *
     * @return bool
     */
    public function isOwnedBy($reservationId, $userId)
    {
        return $this->exists(['id' => $reservationId, 'user_id' => $userId]);
    }

    /**
     * Finds the Reservations owned by the user.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options An array containing the user to be searched for.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findOwnedBy($query, $options)
    {
        $userId = $options['userId'];

        return $query->where(['Reservations.user_id' => $userId]);
    }

    /**
     * Finds the Reservations owned by the user.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options An array containing the user to be searched for.
     *
     * @return \Cake\ORM\Query The modified query.
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function findActive($query, $options)
    {
        return $query->contain('ReservationStatuses')->where(['ReservationStatuses.active' => true]);
    }

    /**
     * Writes the max value to the Logistic
     *
     * @param \Cake\Event\Event $event The event trigger.
     *
     * @return true
     */
    public function beforeSave($event)
    {
        /** @var \App\Model\Entity\Reservation $entity */
        $entity = $event->getData('entity');

        if ($entity->isNew()) {
            $resCode = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 3);

            $entity->set('reservation_code', $resCode);

            $expiry = Configure::read('Schedule.reservation', '+10 days');

            $now = Time::now();
            $expiryDate = $now->modify($expiry);

            $entity->set('expires', $expiryDate);
        }

        return true;
    }
}
