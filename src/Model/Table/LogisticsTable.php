<?php
namespace App\Model\Table;

use Cake\Database\Schema\TableSchema;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logistics Model
 *
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\ParametersTable|\Cake\ORM\Association\BelongsTo $Parameters
 * @property \App\Model\Table\LogisticItemsTable|\Cake\ORM\Association\HasMany $LogisticItems
 *
 * @method \App\Model\Entity\Logistic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Logistic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Logistic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Logistic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistic|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Logistic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Logistic findOrCreate($search, callable $callback = null, $options = [])
 */
class LogisticsTable extends Table
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

        $this->setTable('logistics');
        $this->setDisplayField('header');
        $this->setPrimaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id'
        ]);
        $this->belongsTo('Parameters', [
            'foreignKey' => 'parameter_id'
        ]);
        $this->hasMany('LogisticItems', [
            'foreignKey' => 'logistic_id'
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
            ->scalar('header')
            ->maxLength('header', 45)
            ->requirePresence('header')
            ->allowEmptyString('header', false);

        $validator
            ->scalar('text')
            ->maxLength('text', 999)
            ->requirePresence('text')
            ->allowEmptyString('text');

        $validator
            ->allowEmptyString('variable_max_values');

        $validator
            ->integer('max_value')
            ->allowEmptyString('max_value');

        return $validator;
    }

    /**
     * @param \Cake\Database\Schema\TableSchema $schema The Schema to be modified
     *
     * @return TableSchema|\Cake\Database\Schema\TableSchema
     */
    protected function _initializeSchema($schema)
    {
        $schema->setColumnType('variable_max_values', 'json');

        return $schema;
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
        $rules->add($rules->existsIn(['parameter_id'], 'Parameters'));

        return $rules;
    }

    /**
     * @param int $logisticId Parse Logistic Availability
     *
     * @return void
     */
    public function parseLogisticAvailability($logisticId)
    {
        $logistic = $this->get($logisticId, ['contain' => ['Parameters.Params']]);
        $maxVariable = $logistic->get('variable_max_values');

        if (!is_array($maxVariable)) {
            return;
        }

        foreach ($logistic->parameter->params as $param) {
            $current = $this->LogisticItems->find('all')->where([
                'logistic_id' => $logistic->id,
                'param_id' => $param->id,
            ])->count();

            $maxVariable[$param->id]['current'] = $current;
            $maxVariable[$param->id]['remaining'] = $maxVariable[$param->id]['limit'] - $current;
        }

        $logistic->set('variable_max_values', $maxVariable);
        $this->save($logistic);
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
        /** @var \App\Model\Entity\Logistic $entity */
        $entity = $event->getData('entity');

        $variableMax = $entity->get('variable_max_values');
        $total = 0;

        foreach ($variableMax as $variable) {
            $total += $variable['limit'];
        }

        $entity->set('max_value', $total);

        return true;
    }
}
