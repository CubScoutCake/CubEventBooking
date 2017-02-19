<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InvoiceTexts
 * @property \Cake\ORM\Association\BelongsTo $LegalTexts
 * @property \Cake\ORM\Association\HasMany $Events
 *
 * @method \App\Model\Entity\EventType get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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

        $this->table('event_types');
        $this->displayField('event_type');
        $this->primaryKey('id');

        $this->belongsTo('Settings', [
                'foreignKey' => 'invoice_text_id',
                'property' => 'invoice_text',
                'conditions' => ['Settings.setting_type_id' => 4],
            ]);
        $this->belongsTo('Settings', [
                'foreignKey' => 'legal_text_id',
                'property' => 'legal_text',
                'conditions' => ['Settings.setting_type_id' => 3],
            ]);
        $this->belongsTo('Settings', [
                'foreignKey' => 'application_ref_id',
                'property' => 'application_term',
                'conditions' => ['Settings.setting_type_id' => 6],
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('event_type', 'create')
            ->notEmpty('event_type');

        $validator
            ->boolean('simple_booking')
            ->allowEmpty('simple_booking');

        $validator
            ->boolean('date_of_birth')
            ->allowEmpty('date_of_birth');

        $validator
            ->boolean('medical')
            ->allowEmpty('medical');

        $validator
            ->boolean('dietary')
            ->allowEmpty('dietary');

        $validator
            ->boolean('parent_applications')
            ->allowEmpty('parent_applications');

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
        $rules->add($rules->existsIn(['invoice_text_id'], 'Settings'));
        $rules->add($rules->existsIn(['legal_text_id'], 'Settings'));
        $rules->add($rules->existsIn(['application_ref_id'], 'Settings'));

        return $rules;
    }
}
