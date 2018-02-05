<?php
namespace App\Model\Table;

use Cake\I18n\Time;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \App\Model\Table\DiscountsTable|\Cake\ORM\Association\BelongsTo $Discounts
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $AdminUsers
 * @property \App\Model\Table\EventTypesTable|\Cake\ORM\Association\BelongsTo $EventTypes
 * @property \App\Model\Table\SectionTypesTable|\Cake\ORM\Association\BelongsTo $SectionTypes
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\HasMany $Applications
 * @property \App\Model\Table\LogisticsTable|\Cake\ORM\Association\HasMany $Logistics
 * @property \App\Model\Table\PricesTable|\Cake\ORM\Association\HasMany $Prices
 * @property \App\Model\Table\SettingsTable|\Cake\ORM\Association\HasMany $Settings
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EventTypes', [
            'foreignKey' => 'event_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SectionTypes', [
            'foreignKey' => 'section_type_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 18)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 255)
            ->requirePresence('full_name', 'create')
            ->notEmpty('full_name');

        $validator
            ->boolean('live')
            ->allowEmpty('live');

        $validator
            ->boolean('new_apps')
            ->allowEmpty('new_apps');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->boolean('deposit')
            ->allowEmpty('deposit');

        $validator
            ->dateTime('deposit_date')
            ->allowEmpty('deposit_date');

        $validator
            ->numeric('deposit_value')
            ->allowEmpty('deposit_value');

        $validator
            ->boolean('deposit_inc_leaders')
            ->allowEmpty('deposit_inc_leaders');

        $validator
            ->scalar('deposit_text')
            ->maxLength('deposit_text', 45)
            ->allowEmpty('deposit_text');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->requirePresence('logo', 'create')
            ->notEmpty('logo');

        $validator
            ->scalar('address')
            ->maxLength('address', 45)
            ->allowEmpty('address');

        $validator
            ->scalar('city')
            ->maxLength('city', 45)
            ->allowEmpty('city');

        $validator
            ->scalar('county')
            ->maxLength('county', 45)
            ->allowEmpty('county');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 45)
            ->allowEmpty('postcode');

        $validator
            ->scalar('intro_text')
            ->maxLength('intro_text', 999)
            ->allowEmpty('intro_text');

        $validator
            ->scalar('tagline_text')
            ->maxLength('tagline_text', 125)
            ->allowEmpty('tagline_text');

        $validator
            ->scalar('location')
            ->maxLength('location', 45)
            ->requirePresence('location', 'create')
            ->notEmpty('location');

        $validator
            ->boolean('max')
            ->allowEmpty('max');

        $validator
            ->boolean('allow_reductions')
            ->allowEmpty('allow_reductions');

        $validator
            ->boolean('invoices_locked')
            ->allowEmpty('invoices_locked');

        $validator
            ->scalar('admin_firstname')
            ->maxLength('admin_firstname', 45)
            ->requirePresence('admin_firstname', 'create')
            ->notEmpty('admin_firstname');

        $validator
            ->scalar('admin_lastname')
            ->maxLength('admin_lastname', 45)
            ->requirePresence('admin_lastname', 'create')
            ->notEmpty('admin_lastname');

        $validator
            ->email('admin_email')
            ->maxLength('admin_email', 255)
            ->requirePresence('admin_email', 'create')
            ->notEmpty('admin_email');

        $validator
            ->integer('max_apps')
            ->allowEmpty('max_apps');

        $validator
            ->integer('max_section')
            ->allowEmpty('max_section');

        $validator
            ->dateTime('closing_date')
            ->allowEmpty('closing_date');

        $validator
            ->boolean('complete')
            ->allowEmpty('complete');

        $validator
            ->boolean('team_price')
            ->allowEmpty('team_price');

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
        return $query->where(['Events.live' => true]);
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

        if (bindec($name) == bindec($prices)) {
            $event->complete = true;

            $this->save($event);

            return true;
        }

        return false;
    }
}
