<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailSends Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\NotificationTypesTable|\Cake\ORM\Association\BelongsTo $NotificationTypes
 * @property \App\Model\Table\NotificationsTable|\Cake\ORM\Association\BelongsTo $Notifications
 * @property \App\Model\Table\EmailResponsesTable|\Cake\ORM\Association\HasMany $EmailResponses
 * @property \App\Model\Table\TokensTable|\Cake\ORM\Association\HasMany $Tokens
 *
 * @method \App\Model\Entity\EmailSend get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailSend newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailSend[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailSend|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailSend saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailSend patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailSend[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailSend findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailSendsTable extends Table
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

        $this->setTable('email_sends');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('NotificationTypes', [
            'foreignKey' => 'notification_type_id'
        ]);
        $this->belongsTo('Notifications', [
            'foreignKey' => 'notification_id'
        ]);
        $this->hasMany('EmailResponses', [
            'foreignKey' => 'email_send_id'
        ]);
        $this->hasMany('Tokens', [
            'foreignKey' => 'email_send_id'
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
            ->dateTime('sent')
            ->allowEmptyDateTime('sent');

        $validator
            ->scalar('message_send_code')
            ->maxLength('message_send_code', 255)
            ->add('message_send_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->allowEmptyString('message_send_code');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 511)
            ->allowEmptyString('subject');

        $validator
            ->scalar('routing_domain')
            ->maxLength('routing_domain', 255)
            ->allowEmptyString('routing_domain');

        $validator
            ->scalar('from_address')
            ->maxLength('from_address', 511)
            ->allowEmptyString('from_address');

        $validator
            ->scalar('friendly_from')
            ->maxLength('friendly_from', 255)
            ->allowEmptyString('friendly_from');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        $validator
            ->scalar('email_generation_code')
            ->maxLength('email_generation_code', 30)
            ->add('message_send_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->allowEmptyString('email_generation_code');

        $validator
            ->scalar('email_template')
            ->maxLength('email_template', 30)
            ->allowEmptyString('email_template');

        $validator
            ->boolean('include_token')
            ->allowEmptyString('include_token');

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
        $rules->add($rules->existsIn(['notification_type_id'], 'NotificationTypes'));
        $rules->add($rules->existsIn(['notification_id'], 'Notifications'));

        $rules->add($rules->isUnique(['email_generation_code']));
        $rules->add($rules->isUnique(['message_send_code']));

        return $rules;
    }
}
