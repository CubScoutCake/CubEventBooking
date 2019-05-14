<?php
namespace App\Model\Table;

use App\Model\Entity\Event;
use App\Model\Entity\Param;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \App\Model\Table\DiscountsTable|\Cake\ORM\Association\BelongsTo $Discounts
 * @property |\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\EventTypesTable|\Cake\ORM\Association\BelongsTo $EventTypes
 * @property \App\Model\Table\SectionTypesTable|\Cake\ORM\Association\BelongsTo $SectionTypes
 * @property \App\Model\Table\EventStatusesTable|\Cake\ORM\Association\BelongsTo $EventStatuses
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\HasMany $Applications
 * @property \App\Model\Table\LogisticsTable|\Cake\ORM\Association\HasMany $Logistics
 * @property \App\Model\Table\PricesTable|\Cake\ORM\Association\HasMany $Prices
 * @property \App\Model\Table\ReservationsTable|\Cake\ORM\Association\HasMany $Reservations
 * @property \App\Model\Table\SettingsTable|\Cake\ORM\Association\HasMany $Settings
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('name');
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

        $this->belongsTo('Discounts', [
            'foreignKey' => 'discount_id'
        ]);
        $this->belongsTo('AdminUsers', [
            'className' => 'Users',
            'foreignKey' => 'admin_user_id',
        ]);
        $this->belongsTo('EventTypes', [
            'foreignKey' => 'event_type_id',
        ]);
        $this->belongsTo('SectionTypes', [
            'foreignKey' => 'section_type_id',
        ]);
        $this->belongsTo('EventStatuses', [
            'foreignKey' => 'event_status_id',
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Logistics', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Prices', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Settings', [
            'foreignKey' => 'event_id'
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
            ->scalar('name')
            ->maxLength('name', 18)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 255)
            ->requirePresence('full_name', 'create')
            ->allowEmptyString('full_name', false);

        $validator
            ->boolean('live')
            ->allowEmptyString('live');

        $validator
            ->boolean('force_full')
            ->allowEmptyString('force_full');

        $validator
            ->boolean('new_apps')
            ->allowEmptyString('new_apps');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->allowEmptyDateTime('start_date', false);

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->allowEmptyDateTime('end_date', false);

        $validator
            ->boolean('deposit')
            ->allowEmptyString('deposit');

        $validator
            ->dateTime('deposit_date')
            ->allowEmptyDateTime('deposit_date');

        $validator
            ->boolean('deposit_inc_leaders')
            ->allowEmptyString('deposit_inc_leaders');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->requirePresence('logo', 'create')
            ->allowEmptyString('logo', false);

        $validator
            ->scalar('intro_text')
            ->maxLength('intro_text', 999)
            ->allowEmptyString('intro_text');

        $validator
            ->scalar('location')
            ->maxLength('location', 45)
            ->requirePresence('location', 'create')
            ->allowEmptyString('location', false);

        $validator
            ->boolean('max')
            ->allowEmptyString('max');

        $validator
            ->boolean('allow_reductions')
            ->allowEmptyString('allow_reductions');

        $validator
            ->boolean('invoices_locked')
            ->allowEmptyString('invoices_locked');

        $validator
            ->integer('max_apps')
            ->allowEmptyString('max_apps');

        $validator
            ->integer('max_section')
            ->allowEmptyString('max_section');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        $validator
            ->dateTime('closing_date')
            ->allowEmptyDateTime('closing_date');

        $validator
            ->integer('cc_apps')
            ->allowEmptyString('cc_apps');

        $validator
            ->boolean('complete')
            ->allowEmptyString('complete');

        $validator
            ->boolean('team_price')
            ->allowEmptyString('team_price');

        $validator
            ->dateTime('opening_date')
            ->allowEmptyDateTime('opening_date');

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
        $rules->add($rules->existsIn(['discount_id'], 'Discounts'));
        $rules->add($rules->existsIn(['admin_user_id'], 'AdminUsers'));
        $rules->add($rules->existsIn(['event_type_id'], 'EventTypes'));
        $rules->add($rules->existsIn(['section_type_id'], 'SectionTypes'));
        $rules->add($rules->existsIn(['event_status_id'], 'EventStatuses'));

        return $rules;
    }

    /**
     * Is a finder which will return a query with non-live (pre-release & archive) events only.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findUnarchived($query)
    {
        return $query->contain('EventStatuses')->where(['EventStatuses.live' => true]);
    }

    /**
     * Will filter events to those which are coming up and haven't happened yet.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findUpcoming($query)
    {
        return $query->where(['Events.end_date >' => Time::now()]);
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $eventId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determineComplete($eventId)
    {
        $event = $this->get($eventId);

        $prices = '0';
        $name = '0';

        if ($event->cc_prices > 0) {
            $prices = '1';
        }

        if (!is_null($event->name)) {
            $name = '1';
        }

        $bin = $name . $prices;
        $def = '1' . '1';

        if (bindec($bin) == bindec($def)) {
            return true;
        }

        return false;
    }

    /**
     * Method to determine the maximum section numbers for an event.
     *
     * @param int $eventId The booking Event
     *
     * @return int|bool
     */
    public function getPriceSection($eventId)
    {
        $event = $this->get($eventId, ['contain' => [
            'Prices.ItemTypes',
            'SectionTypes'
        ]]);

        if (!($event instanceof Event)) {
            return false;
        }

        $max = 0;

        if ($event->team_price) {
            foreach ($event->prices as $price) {
                if ($price->item_type->team_price && $price->max_number > $max) {
                    $max = $price->max_number;
                }
            }

            return $max;
        }

        if ($event->cc_prices > 0) {
            foreach ($event->prices as $price) {
                if ($price->item_type->role_id == $event->section_type->role_id && $price->item_type->available) {
                    if ($price->max_number > $max) {
                        $max = $price->max_number;
                    }
                }
            }
        }

        return $max;
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

        $now = Time::now();
        $difference = $now->diff($date);

        if ($difference->invert != 0) {
            return true;
        }

        return false;
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $eventId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determinePending($eventId)
    {
        $event = $this->get($eventId);

        return !$this->determineDateOccurred($event->opening_date);
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $eventId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determineClosed($eventId)
    {
        $event = $this->get($eventId);

        return $this->determineDateOccurred($event->closing_date);
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $eventId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determineStarted($eventId)
    {
        $event = $this->get($eventId);

        return $this->determineDateOccurred($event->start_date);
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $eventId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determineOver($eventId)
    {
        $event = $this->get($eventId);

        return $this->determineDateOccurred($event->end_date);
    }

    /**
     * Various Event Completion Analyses.
     *
     * @param int $eventId The Id for the Event to be completed.
     *
     * @return bool
     */
    public function determineFull($eventId)
    {
        $event = $this->get($eventId);

        return $event->app_full;
    }

    /**
     * Method to determine the correct status for an event
     *
     * @param int $eventId The booking Event
     *
     * @return int
     */
    public function determineEventStatus($eventId)
    {
        $complete = $this->determineComplete($eventId);
        $pending = $this->determinePending($eventId);
        $started = $this->determineStarted($eventId);
        $over = $this->determineOver($eventId);
        $full = $this->determineFull($eventId);

        if ($over || $started) {
            $query = $this->EventStatuses->find('core')->orderDesc('status_order');
            $lastStatus = $query->first();
            if ($over) {
                return $lastStatus->id;
            }

            return $query->where(['id <>' => $lastStatus->id])->first()->id;
        }

        if ($full) {
            return $this->EventStatuses->find('core')->where([
                'live' => $complete,
                'pending_date' => $pending,
                'accepting_applications' => !$full,
                'spaces_full' => $full,
            ])->orderAsc('status_order')->first()->id;
        }

        $matching = $this->EventStatuses->find('core')->where([
            'live' => $complete,
            'pending_date' => $pending,
            'accepting_applications' => (!$pending && $complete && !$full),
        ])->orderAsc('status_order');

        if ($matching->count() == 1) {
            return $matching->first()->id;
        }

        return $this->EventStatuses->find('core')->orderAsc('status_order')->first()->id;
    }

    /**
     * @param int $eventId The Event ID
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function checkEventOpen($eventId)
    {
        $event = $this->get($eventId, ['contain' => 'EventStatuses']);

        if (!$event->event_status->accepting_applications) {
            return false;
        }

        return true;
    }

    /**
     * @param int $eventId The Event ID
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function schedule($eventId)
    {
        $event = $this->get($eventId);

        $status = $this->determineEventStatus($eventId);

        if ($status <> $event->event_status_id) {
            $event->set('event_status_id', $status);
            $this->save($event);

            return true;
        }

        return false;
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
        /** @var \App\Model\Entity\Event $entity */
        $entity = $event->getData('entity');

        if (isset($entity->id)) {
            $correctStatus = $this->determineEventStatus($entity->id);
            $entity->set('event_status_id', $correctStatus);

            /** @var \App\Model\Entity\EventStatus $status */
            $status = $this->EventStatuses->get($correctStatus);

            $entity->set('new_apps', $status->accepting_applications);
            $entity->set('live', $status->live);

            $entity->set('complete', $this->determineComplete($entity->id));

            if ($entity->isDirty('event_status_id')) {
                Log::info($entity->name . ' Status ' . $this->EventStatuses->get($entity->event_status_id)->event_status);
            }
        }

        return true;
    }
}
