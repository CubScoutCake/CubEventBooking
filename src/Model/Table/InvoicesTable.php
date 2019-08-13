<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoices Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\BelongsTo $Applications
 * @property \App\Model\Table\ReservationsTable|\Cake\ORM\Association\BelongsTo $Reservations
 * @property \App\Model\Table\InvoiceItemsTable|\Cake\ORM\Association\HasMany $InvoiceItems
 * @property \App\Model\Table\NotesTable|\Cake\ORM\Association\HasMany $Notes
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\BelongsToMany $Payments
 *
 * @method \App\Model\Entity\Invoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Invoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Invoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Invoice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InvoicesTable extends Table
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

        $this->setTable('invoices');
        $this->setDisplayField('id');
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

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id'
        ]);
        $this->belongsTo('Reservations', [
            'foreignKey' => 'reservation_id'
        ]);
        $this->hasMany('InvoiceItems', [
            'foreignKey' => 'invoice_id',
            'conditions' => ['InvoiceItems.schedule_line' => false],
        ]);
        $this->hasMany('ScheduleItems', [
            'className' => 'InvoiceItems',
            'foreignKey' => 'invoice_id',
            'property' => 'schedule_items',
            'conditions' => ['ScheduleItems.schedule_line' => true],
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'invoice_id'
        ]);
        $this->belongsToMany('Payments', [
            'through' => 'InvoicesPayments',
            'cascadeCallbacks' => true,
        ]);

        // Adding Counter Caches

        $this->addBehavior('CounterCache', [
            'Applications' => ['cc_inv_count']
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
            ->boolean('paid')
            ->allowEmptyString('paid');

        $validator
            ->numeric('initialvalue')
            ->allowEmptyString('initialvalue');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['application_id'], 'Applications'));
        $rules->add($rules->existsIn(['reservation_id'], 'Reservations'));

        return $rules;
    }

    /**
     * Is Owned By Function method
     *
     * @param int $invoiceId The configuration for the Table.
     * @param int $userId The configuration for the Table.
     * @return \App\Model\Entity\Invoice The Auth function for ownership;
     */
    public function isOwnedBy($invoiceId, $userId)
    {
        return $this->exists(['id' => $invoiceId, 'user_id' => $userId]);
    }

    /**
     * Find Owned By Filter method
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @param array $options The user in an Array.
     * @return \Cake\ORM\Query
     */
    public function findOwnedBy($query, $options)
    {
        $user = $options['user'];

        return $query->where(['Invoices.user_id' => $user->id]);
    }

    /**
     * Find Invoices which haven't been settled.
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @return \Cake\ORM\Query
     */
    public function findOutstanding($query)
    {
        return $query->where(['Invoices.value < Invoices.initialvalue'])->orWhere(['Invoices.value IS' => null]);
    }

    /**
     * Find Invoices which haven't had any value paid.
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @return \Cake\ORM\Query
     */
    public function findUnpaid($query)
    {
        return $query->where(['Invoices.value IS' => 0])->orWhere(['Invoices.value IS' => null]);
    }

    /**
     * Find Active Invoices
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @return \Cake\ORM\Query
     */
    public function findActive($query)
    {
        return $query
            ->contain([
                'Reservations.ReservationStatuses',
                'Applications.ApplicationStatuses'
            ])
            ->where([
                'OR' => [
                    'ApplicationStatuses.active' => true,
                    'ReservationStatuses.active' => true,
                ]
            ]);
    }

    /**
     * Find Invoices which are not on an event which has been archived.
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @return \Cake\ORM\Query
     */
    public function findUnarchived($query)
    {
        $matchingReservations = $this
            ->getAssociation('Reservations.Events')->find()
            ->select(['Invoices.id'])
            ->innerJoinWith('Reservations.Invoices')
            ->distinct()
            ->where(['Events.live' => true]);

        $matchingApplications = $this
            ->getAssociation('Applications.Events')->find()
            ->select(['Invoices.id'])
            ->innerJoinWith('Applications.Invoices')
            ->distinct()
            ->where(['Events.live' => true]);

        return $query->where([
            'OR' => [
                'Invoices.id IN' => $matchingApplications,
                'Invoices.id IN ' => $matchingReservations,
            ]
         ]);
    }

//    /**
//     * Find with I
//     *
//     * @param \Cake\ORM\Query $query an existing ORM Query.
//     *
//     * @return \Cake\ORM\Query
//     */
//    public function findBoth($query)
//    {
//        return $query
//            ->leftJoin([
//                'Reservations' => [
//                    'table' => 'reservations',
//                    'type' => 'LEFT',
//                    'conditions' => 'Reservations.id = Invoices.reservation_id',
//                ],
//                'Applications' => [
//                    'table' => 'applications',
//                    'type' => 'LEFT',
//                    'conditions' => 'Applications.id = Invoices.application_id',
//                ]
//            ]);
//    }

    /**
     * Find Invoices which are not on an event which has been archived.
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @return \Cake\ORM\Query
     */
    public function findTotalValue($query)
    {
        return $query->select(['sum' => $query->func()->sum('value')])->group('id');
    }

    /**
     * Find Invoices which are not on an event which has been archived.
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @return \Cake\ORM\Query
     */
    public function findTotalInitialValue($query)
    {
        return $query->select(['sum' => $query->func()->sum('initialvalue')])->group('id');
    }
}
