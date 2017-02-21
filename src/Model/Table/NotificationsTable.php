<?php
namespace App\Model\Table;

use App\Model\Entity\Notification;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notifications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Notificationtypes
 * @property \Cake\ORM\Association\BelongsTo $Links
 */
class NotificationsTable extends Table
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

        $this->table('notifications');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
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
            ->add('new', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('new');

        $validator
            ->allowEmpty('notification_header');

        $validator
            ->allowEmpty('text');

        $validator
            ->add('read_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('read_date');

        $validator
            ->allowEmpty('notification_source');

        $validator
            ->allowEmpty('link_controller');

        $validator
            ->allowEmpty('link_prefix');

        $validator
            ->allowEmpty('link_action');

        $validator
            ->add('link_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('link_id');

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
        $rules->add($rules->existsIn(['notificationtype_id'], 'Notificationtypes'));

        return $rules;
    }

    /**
     * Returns a modified query, filtering to unread Notifications.
     *
     * @param \Cake\ORM\Query $query The query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findUnread($query)
    {
        return $query->where(['new' => true]);
    }

    /**
     * Returns a modified query, filtering to unread Notifications.
     *
     * @param int $notificationId The query to be modified.
     * @param int $userId The user to check for ownership.
     * @return \App\Model\Entity\Notification
     */
    public function isOwnedBy($notificationId, $userId)
    {
        return $this->exists(['id' => $notificationId, 'user_id' => $userId]);
    }
}
