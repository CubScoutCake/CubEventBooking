<?php
namespace App\Model\Table;

use App\Model\Entity\Invoice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $InvoiceItems
 * @property \Cake\ORM\Association\BelongsToMany $Payments
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

        $this->table('invoices');
        $this->displayField('id');
        $this->primaryKey('id');

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
        $this->hasMany('InvoiceItems', [
            'foreignKey' => 'invoice_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'invoice_id'
        ]);
        $this->belongsToMany('Payments', [
            'through' => 'InvoicesPayments',
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('value', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('value');

        $validator
            ->add('paid', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('paid');

        $validator
            ->add('initialvalue', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('initialvalue');

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
     * Find Invoices which are not on an event which has been archived.
     *
     * @param \Cake\ORM\Query $query an existing ORM Query.
     * @return \Cake\ORM\Query
     */
    public function findUnarchived($query)
    {
        return $query->contain('Applications.Events')->where(['Events.live' => true]);
    }
}
