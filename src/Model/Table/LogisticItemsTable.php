<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LogisticItems Model
 *
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\BelongsTo $Applications
 * @property \App\Model\Table\LogisticsTable|\Cake\ORM\Association\BelongsTo $Logistics
 * @property \App\Model\Table\ParamsTable|\Cake\ORM\Association\BelongsTo $Params
 * @property |\Cake\ORM\Association\BelongsTo $Reservations
 *
 * @method \App\Model\Entity\LogisticItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\LogisticItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LogisticItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LogisticItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogisticItem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogisticItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LogisticItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LogisticItem findOrCreate($search, callable $callback = null, $options = [])
 */
class LogisticItemsTable extends Table
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

        $this->setTable('logistic_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted',
        ]);

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
        ]);
        $this->belongsTo('Logistics', [
            'foreignKey' => 'logistic_id',
        ]);
        $this->belongsTo('Params', [
            'foreignKey' => 'param_id',
        ]);
        $this->belongsTo('Reservations', [
            'foreignKey' => 'reservation_id',
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
            ->dateTime('deleted')
            ->allowEmpty('deleted');

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
        $rules->add($rules->existsIn(['application_id'], 'Applications'));
        $rules->add($rules->existsIn(['logistic_id'], 'Logistics'));
        $rules->add($rules->existsIn(['param_id'], 'Params'));
        $rules->add($rules->existsIn(['reservation_id'], 'Reservations'));

        return $rules;
    }

    /**
     * Event Trigger for After Saving a Logistic Item.
     *
     * @param \Cake\Event\Event $event The Cake Event being triggered
     * @param \App\Model\Entity\LogisticItem $entity The Entity being Changed
     * @param array $options The Options Array.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterSave($event, $entity, $options)
    {
        $this->Logistics->parseLogisticAvailability($entity->logistic_id);
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
        return $query->contain('Reservations.ReservationStatuses')->where(['ReservationStatuses.active' => true]);
    }
}
