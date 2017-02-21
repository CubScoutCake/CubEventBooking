<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailSends Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Messages
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $NotificationTypes
 * @property \Cake\ORM\Association\BelongsTo $Notifications
 * @property \Cake\ORM\Association\HasMany $EmailResponses
 * @property \Cake\ORM\Association\HasMany $Tokens
 *
 * @method \App\Model\Entity\EmailSend get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailSend newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailSend[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailSend|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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

        $this->table('email_sends');
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
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('sent')
            ->allowEmpty('sent');

        $validator
            ->allowEmpty('subject');

        $validator
            ->allowEmpty('routing_domain');

        $validator
            ->allowEmpty('from_address');

        $validator
            ->allowEmpty('friendly_from');

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

        return $rules;
    }
}
