<?php
namespace App\Model\Table;

use App\Model\Entity\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Settings
 * @property \Cake\ORM\Association\BelongsTo $Settings
 * @property \Cake\ORM\Association\BelongsTo $Discounts
 * @property \Cake\ORM\Association\HasMany $Applications
 * @property \Cake\ORM\Association\HasMany $Settings
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

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                    ]
                ]
            ]);

        $this->belongsTo('Settings', [
            'foreignKey' => 'invtext_id'
        ]);
        $this->belongsTo('Settings', [
            'foreignKey' => 'legaltext_id'
        ]);
        $this->belongsTo('Discounts', [
            'foreignKey' => 'discount_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Settings', [
            'foreignKey' => 'event_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'admin_user_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('full_name', 'create')
            ->notEmpty('full_name');

        $validator
            ->add('live', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('live');

        $validator
            ->add('new_apps', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('new_apps');

        $validator
            ->add('start', 'valid', ['rule' => 'datetime'])
            ->requirePresence('start', 'create')
            ->notEmpty('start');

        $validator
            ->add('end', 'valid', ['rule' => 'datetime'])
            ->requirePresence('end', 'create')
            ->notEmpty('end');

        $validator
            ->add('deposit', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('deposit');

        $validator
            ->add('deposit_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('deposit_date');

        $validator
            ->add('deposit_value', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('deposit_value');

        $validator
            ->add('deposit_inc_leaders', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('deposit_inc_leaders');

        $validator
            ->allowEmpty('deposit_text');

        $validator
            ->add('cubs', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('cubs');

        $validator
            ->add('cubs_value', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('cubs_value');

        $validator
            ->allowEmpty('cubs_text');

        $validator
            ->add('yls', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('yls');

        $validator
            ->add('yls_value', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('yls_value');

        $validator
            ->allowEmpty('yls_text');

        $validator
            ->add('leaders', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('leaders');

        $validator
            ->add('leaders_value', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('leaders_value');

        $validator
            ->allowEmpty('leaders_text');

        $validator
            ->requirePresence('logo', 'create')
            ->notEmpty('logo');

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
            ->requirePresence('location', 'create')
            ->notEmpty('location');

        $validator
            ->add('max', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('max');

        $validator
            ->add('max_cubs', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('max_cubs');

        $validator
            ->add('max_yls', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('max_yls');

        $validator
            ->add('max_leaders', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('max_leaders');

        $validator
            ->add('allow_reductions', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('allow_reductions');

        $validator
            ->add('logo_ratio', 'valid', ['rule' => 'numeric'])
            ->requirePresence('logo_ratio', 'create')
            ->notEmpty('logo_ratio');

        $validator
            ->add('invoices_locked', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('invoices_locked');

        $validator
            ->requirePresence('admin_firstname', 'create')
            ->notEmpty('admin_firstname');

        $validator
            ->requirePresence('admin_lastname', 'create')
            ->notEmpty('admin_lastname');

        $validator
            ->add('admin_email', 'valid', ['rule' => 'email'])
            ->requirePresence('admin_email', 'create')
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
        $rules->add($rules->existsIn(['invtext_id'], 'Settings'));
        $rules->add($rules->existsIn(['legaltext_id'], 'Settings'));
        $rules->add($rules->existsIn(['discount_id'], 'Discounts'));
        $rules->add($rules->existsIn(['admin_user_id'], 'Users'));
        return $rules;
    }
}
