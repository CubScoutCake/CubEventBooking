<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventTypes Model
 *
 * @property \App\Model\Table\SettingsTable|\Cake\ORM\Association\BelongsTo $LegalTexts
 * @property \App\Model\Table\SettingsTable|\Cake\ORM\Association\BelongsTo $InvoiceTexts
 * @property \App\Model\Table\SettingsTable|\Cake\ORM\Association\BelongsTo $ApplicationRefs
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\HasMany $Events
 *
 * @method \App\Model\Entity\EventType get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventType findOrCreate($search, callable $callback = null, $options = [])
 */
class EventTypesTable extends Table
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

        $this->setTable('event_types');
        $this->setDisplayField('event_type');
        $this->setPrimaryKey('id');

        $this->belongsTo('InvoiceTexts', [
                'className' => 'Settings',
                'foreignKey' => 'invoice_text_id',
                'property' => 'invoice_text',
                'conditions' => ['InvoiceTexts.setting_type_id' => 4],
            ]);
        $this->belongsTo('LegalTexts', [
                'className' => 'Settings',
                'foreignKey' => 'legal_text_id',
                'property' => 'legal_text',
                'conditions' => ['LegalTexts.setting_type_id' => 3],
            ]);
        $this->belongsTo('ApplicationRefs', [
                'className' => 'Settings',
                'foreignKey' => 'application_ref_id',
                'property' => 'application_term',
                'conditions' => ['ApplicationRefs.setting_type_id' => 6],
            ]);
        $this->belongsTo('Payable', [
            'className' => 'Settings',
            'foreignKey' => 'payable_setting_id',
            'property' => 'payable',
            'conditions' => ['Payable.setting_type_id' => 7],
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'event_type_id'
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
            ->scalar('event_type')
            ->maxLength('event_type', 255)
            ->requirePresence('event_type', 'create')
            ->allowEmptyString('event_type', false);

        $validator
            ->boolean('simple_booking')
            ->allowEmptyString('simple_booking');

        $validator
            ->boolean('date_of_birth')
            ->allowEmptyString('date_of_birth');

        $validator
            ->boolean('medical')
            ->allowEmptyString('medical');

        $validator
            ->boolean('dietary')
            ->allowEmptyString('dietary');

        $validator
            ->boolean('parent_applications')
            ->allowEmptyString('parent_applications');

        $validator
            ->boolean('team_leader')
            ->allowEmptyString('team_leader');

        $validator
            ->boolean('permit_holder')
            ->allowEmptyString('permit_holder');

        $validator
            ->boolean('display_availability')
            ->requirePresence('display_availability', 'create')
            ->allowEmptyString('display_availability');

        $validator
            ->boolean('sync_book')
            ->requirePresence('sync_book', 'create')
            ->allowEmptyString('sync_book');

        $validator
            ->boolean('hold_booking')
            ->requirePresence('hold_booking', 'create')
            ->allowEmptyString('hold_booking');

        $validator
            ->boolean('attendee_booking')
            ->requirePresence('attendee_booking', 'create')
            ->allowEmptyString('attendee_booking');

        $validator
            ->boolean('district_booking')
            ->requirePresence('district_booking', 'create')
            ->allowEmptyString('district_booking');

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
        $rules->add($rules->existsIn(['invoice_text_id'], 'InvoiceTexts'));
        $rules->add($rules->existsIn(['legal_text_id'], 'LegalTexts'));
        $rules->add($rules->existsIn(['application_ref_id'], 'ApplicationRefs'));
        $rules->add($rules->existsIn(['payable_setting_id'], 'Payable'));

        return $rules;
    }
}
