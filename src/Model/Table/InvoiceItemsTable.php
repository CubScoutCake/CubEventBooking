<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InvoiceItems Model
 *
 * @property \App\Model\Table\InvoicesTable|\Cake\ORM\Association\BelongsTo $Invoices
 * @property \App\Model\Table\ItemTypesTable|\Cake\ORM\Association\BelongsTo $ItemTypes
 *
 * @method \App\Model\Entity\InvoiceItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\InvoiceItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InvoiceItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceItem findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoiceItemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariables)
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('invoice_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Invoices', [
            'foreignKey' => 'invoice_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ItemTypes', [
            'foreignKey' => 'item_type_id'
        ]);

        $this->addBehavior('CounterCache', [
            'Invoices' => [
                'initialvalue' => function ($event, $entity, $table) {

                    $query = $this->find()->where([
                        'invoice_id' => $entity->invoice_id,
                        'schedule_line' => false,
                    ]);
                    $query = $query->select(['sum' => $query->func()->sum('(value * quantity)')]);
                    $query = $query->first();

                    return $query->sum;
                }
            ]
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
            ->numeric('value')
            ->allowEmptyString('value');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->integer('quantity')
            ->allowEmptyString('quantity');

        $validator
            ->boolean('visible')
            ->allowEmptyString('visible');

        $validator
            ->boolean('schedule_line')
            ->allowEmptyString('schedule_line');

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
        $rules->add($rules->existsIn(['invoice_id'], 'Invoices'));
        $rules->add($rules->existsIn(['item_type_id'], 'ItemTypes'));

        return $rules;
    }

    /**
     * @param \Cake\ORM\Query $query Query Object
     * @param array $options The Options Array
     *
     * @return array|\Cake\ORM\Query
     */
    public function findMinors(Query $query, $options)
    {
        $query = $query->contain('ItemTypes')->where(['ItemTypes.deposit' => false]);

        if (!key_exists('application_id', $options)) {
            return $query
                ->contain(['Invoices.Applications', 'ItemTypes'])
                ->where(['ItemTypes.minor' => true]);
        }

        if (!key_exists('role_id', $options)) {
            return $query
                ->contain(['Invoices.Applications', 'ItemTypes'])
                ->where(['Applications.id' => $options['application_id'], 'ItemTypes.minor' => true]);
        }

        return $query
            ->contain(['Invoices.Applications', 'ItemTypes'])
            ->where([
                'Applications.id' => $options['application_id'],
                'ItemTypes.minor' => true,
                'ItemTypes.role_id' => $options['role_id'],
            ]);
    }

    /**
     * @param \Cake\ORM\Query $query Query Object
     * @param array $options The Options Array
     *
     * @return array|\Cake\ORM\Query
     */
    public function findAdults(Query $query, $options)
    {
        $query = $query->contain('ItemTypes')->where(['ItemTypes.deposit' => false]);

        if (!key_exists('application_id', $options)) {
            return $query
                ->contain(['Invoices.Applications', 'ItemTypes'])
                ->where(['ItemTypes.minor' => false]);
        }

        return $query
            ->contain(['Invoices.Applications', 'ItemTypes'])
            ->where(['Applications.id' => $options['application_id'], 'ItemTypes.minor' => false]);
    }

    /**
     * @param Query $query The Query Object
     *
     * @return array|\Cake\ORM\Query
     */
    public function findTotalQuantity($query)
    {
        $query = $query->contain('ItemTypes')->where(['ItemTypes.deposit' => false]);
        $query = $query->select(['count' => $query->func()->sum('quantity')]);

        return $query;
    }
}
