<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailResponseTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $EmailResponses
 *
 * @method \App\Model\Entity\EmailResponseType get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailResponseType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailResponseType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailResponseType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailResponseType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailResponseType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailResponseType findOrCreate($search, callable $callback = null, $options = [])
 */
class EmailResponseTypesTable extends Table
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

        $this->setTable('email_response_types');
        $this->setDisplayField('email_response_type');
        $this->setPrimaryKey('id');

        $this->hasMany('EmailResponses', [
            'foreignKey' => 'email_response_type_id'
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
            ->scalar('email_response_type')
            ->requirePresence('email_response_type', 'create')
            ->maxLength('email_response_type', 255)
            ->allowEmptyString('email_response_type', false);

        $validator
            ->boolean('bounce')
            ->requirePresence('bounce', 'create')
            ->allowEmptyString('bounce', false);

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
        $rules->add($rules->isUnique(['email_response_type']));

        return $rules;
    }
}
