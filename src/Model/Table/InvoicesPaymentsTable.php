<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * InvoicesPayments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Invoices
 * @property \Cake\ORM\Association\BelongsTo $Payments
 *
 * @method \App\Model\Entity\InvoicesPayment get($primaryKey, $options = [])
 * @method \App\Model\Entity\InvoicesPayment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InvoicesPayment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InvoicesPayment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoicesPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InvoicesPayment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InvoicesPayment findOrCreate($search, callable $callback = null)
 */
class InvoicesPaymentsTable extends Table
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

        $this->setTable('invoices_payments');
        $this->setDisplayField('payment_id');
        $this->setPrimaryKey(['payment_id', 'invoice_id']);

        $this->belongsTo('Invoices', [
            'foreignKey' => 'invoice_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Payments', [
            'foreignKey' => 'payment_id',
            'joinType' => 'INNER'
        ]);
        $this->addBehavior('CounterCache', [
            'Invoices' => [
                'value' => function ($event, $entity, $table) {

                    $query = $this->find()->where(['invoice_id' => $entity->invoice_id]);
                    $query = $query->select(['sum' => $query->func()->sum('x_value')]);
                    $query = $query->first();

                    return $query->sum;
                }
            ],
            'Payments' => [
                'value' => function ($event, $entity, $table) {

                    $query = $this->find()->where(['payment_id' => $entity->payment_id]);
                    $query = $query->select(['sum' => $query->func()->sum('x_value')]);
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
            ->numeric('x_value')
            ->requirePresence('x_value', 'create')
            ->notEmpty('x_value');

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
        $rules->add($rules->existsIn(['payment_id'], 'Payments'));

        return $rules;
    }
}
