<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailResponses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EmailSends
 * @property \Cake\ORM\Association\BelongsTo $EmailResponseTypes
 *
 * @method \App\Model\Entity\EmailResponse get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailResponse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailResponse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailResponse|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailResponse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailResponse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailResponse findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailResponsesTable extends Table
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

        $this->table('email_responses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EmailSends', [
            'foreignKey' => 'email_send_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EmailResponseTypes', [
            'foreignKey' => 'email_response_type_id',
            'joinType' => 'INNER'
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
            ->dateTime('received')
            ->allowEmpty('received');

        $validator
            ->allowEmpty('link_clicked');

        $validator
            ->allowEmpty('ip_address');

        $validator
            ->allowEmpty('bounce_reason');

        $validator
            ->integer('message_size')
            ->allowEmpty('message_size');

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
        $rules->add($rules->existsIn(['email_send_id'], 'EmailSends'));
        $rules->add($rules->existsIn(['email_response_type_id'], 'EmailResponseTypes'));

        return $rules;
    }
}
