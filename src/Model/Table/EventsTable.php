<?php
namespace App\Model\Table;

use Cake\I18n\Time;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Discounts
 * @property \Cake\ORM\Association\BelongsTo $AdminUsers
 * @property \Cake\ORM\Association\BelongsTo $EventTypes
 * @property \Cake\ORM\Association\BelongsTo $SectionTypes
 * @property \Cake\ORM\Association\HasMany $Applications
 * @property \Cake\ORM\Association\HasMany $Logistics
 * @property \Cake\ORM\Association\HasMany $Prices
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

        $this->table('events');
        $this->displayField('name');
        $this->primaryKey('id');

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
        $this->hasMany('Settings', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Logistics', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Prices', [
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
            //->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            //->requirePresence('full_name', 'create')
            ->notEmpty('full_name');

        $validator
            ->boolean('live');

        $validator
            ->boolean('new_apps');

        $validator
            ->dateTime('start_date');

        $validator
            ->dateTime('end_date');

        $validator
            ->dateTime('deposit_date');

        $validator
            ->dateTime('closing_date');

        $validator
            ->boolean('deposit');

        $validator
            ->dateTime('deposit_date');

        $validator
            ->boolean('deposit_inc_leaders');

        $validator
            ->allowEmpty('logo');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('county');

        $validator
            ->allowEmpty('postcode');

        $validator
            ->allowEmpty('intro_text');

        $validator
            ->allowEmpty('tagline_text');

        $validator
            //->requirePresence('location', 'create')
            ->notEmpty('location');

        $validator
            ->boolean('max');

        $validator
            ->boolean('allow_reductions');

        $validator
            ->boolean('invoices_locked');

        $validator
            //->requirePresence('admin_firstname', 'create')
            ->notEmpty('admin_firstname');

        $validator
            //->requirePresence('admin_lastname', 'create')
            ->notEmpty('admin_lastname');

        $validator
            ->add('admin_email', 'valid', ['rule' => 'email'])
            //->requirePresence('admin_email', 'create')
            ->notEmpty('admin_email');

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
