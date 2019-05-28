<?php
namespace App\Model\Table;

use App\Utility\TextSafe;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
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
 * @method \App\Model\Entity\Reservation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
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
                    'finder' => 'active',
                ],
                'cc_complete_reservations' => [
                    'finder' => 'complete',
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
        ])
            ->setDependent(true)
            ->setCascadeCallbacks(true);
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
            ->requirePresence('user_id', 'create');

        $validator
            ->allowEmptyString('attendee_id', false)
            ->requirePresence('attendee_id', 'create');

        $validator
            ->allowEmptyString('event_id', false)
            ->requirePresence('event_id', 'create');

        $validator
            ->allowEmptyString('reservation_status_id', false)
            ->requirePresence('reservation_status_id', 'create');

        $validator
            ->dateTime('expires')
            ->allowEmptyDateTime('expires');

        $validator
            ->scalar('reservation_code')
            ->maxLength('reservation_code', 3)
            ->allowEmptyString('reservation_code');

        $validator
            ->boolean('cancelled')
            ->allowEmptyString('cancelled', false);

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
     * Finds the Reservations owned by the user.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options An array containing the user to be searched for.
     *
     * @return \Cake\ORM\Query The modified query.
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function findComplete($query, $options)
    {
        return $query->contain('ReservationStatuses')->where(['ReservationStatuses.complete' => true]);
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
    public function findInProgress($query, $options)
    {
        return $query->contain('ReservationStatuses')->where([
            'ReservationStatuses.complete' => false,
            'ReservationStatuses.cancelled' => false,
        ]);
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
    public function findEventInProgress($query, $options)
    {
        return $query->contain('Events.EventStatuses')->where([
            'EventStatuses.live' => true,
        ]);
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param \Cake\I18n\Time $date The Date to be checked
     *
     * @return bool
     */
    private function determineDateOccurred($date)
    {
        if (is_null($date)) {
            return false;
        }

        $now = FrozenTime::now();
        $difference = $now->diff($date);

        if ($difference->invert != 0) {
            return true;
        }

        return false;
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $reservationId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determineExpired($reservationId)
    {
        $reservation = $this->get($reservationId);

        return $this->determineDateOccurred($reservation->expires);
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $reservationId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determinePaid($reservationId)
    {
        $reservation = $this->get($reservationId, ['contain' => 'Invoices']);

        if (!$reservation->has('invoice')) {
            return false;
        }

        return $reservation->invoice->is_paid;
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $reservationId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determineCancelled($reservationId)
    {
        $reservation = $this->get($reservationId);

        return $reservation->cancelled;
    }

    /**
     * Method to determine the maximum section numbers for an event.
     *
     * @param int $reservationId The booking Event
     *
     * @return int
     */
    public function determineStatus($reservationId)
    {
        $complete = $this->determinePaid($reservationId);
        $expired = $this->determineExpired($reservationId);
        $cancelled = $this->determineCancelled($reservationId);

        if ($complete) {
            $query = $this->ReservationStatuses->find()->where(['reservation_status' => 'Complete']);

            return $query->first()->id;
        }

        if ($cancelled) {
            $query = $this->ReservationStatuses->find()->where(['reservation_status' => 'Cancelled']);

            return $query->first()->id;
        }

        if ($expired) {
            $query = $this->ReservationStatuses->find()->where(['reservation_status' => 'Expired']);

            return $query->first()->id;
        }

        return $this->ReservationStatuses->find()->where(['reservation_status' => 'Pending Payment'])->first()->id;
    }

    /**
     * @param int $reservationId The Event ID
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function schedule($reservationId)
    {
        $reservation = $this->get($reservationId);

        $status = $this->determineStatus($reservationId);

        if ($status <> $reservation->reservation_status_id) {
            $reservation->set('reservation_status_id', $status);
            $this->save($reservation, ['validate' => false]);

            if ($this->ReservationStatuses->get($status)->cancelled) {
                $this->cancelAssociated($reservationId);
            }

            return true;
        }

        return false;
    }

    /**
     * @param int $reservationId The Event ID
     *
     * @return bool|\App\Model\Entity\Reservation
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function cancel($reservationId)
    {
        $reservation = $this->get($reservationId);
        $reservation->set('cancelled', true);

        $this->save($reservation, ['validate' => false]);

        return $this->cancelAssociated($reservationId);
    }

    /**
     * @param int $reservationId The Event ID
     *
     * @return bool|\App\Model\Entity\Reservation
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function cancelAssociated($reservationId)
    {
        $reservation = $this->get($reservationId, ['contain' => ['LogisticItems', 'Invoices', 'ReservationStatuses']]);

        if ($reservation->cancelled) {
            // Delete Invoices Associated
            if ($reservation->has('invoice')) {
                $this->Invoices->delete($reservation->invoice);
            }

            // Delete Logistic Items
            foreach ($reservation->logistic_items as $logisticItem) {
                $this->LogisticItems->delete($logisticItem);
            }

            return $this->save($reservation, ['validate' => false]);
        }

        return $reservation;
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
            $resCode = TextSafe::shuffle(3);

            $entity->set('reservation_code', $resCode);

            $expiry = Configure::read('Schedule.reservation', '+10 days');

            $now = FrozenTime::now();
            $expiryDate = $now->modify($expiry);

            $entity->set('expires', $expiryDate);
        }

        return true;
    }
}
