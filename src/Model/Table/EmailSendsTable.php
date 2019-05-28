<?php
namespace App\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\Mailer\MailerAwareTrait;
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
    use MailerAwareTrait;

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

    /**
     * Is a finder which will return a query with non-live (pre-release & archive) events only.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findUnsent($query)
    {
        return $query->where(function ($exp) {
            /** @var \Cake\Database\Expression\QueryExpression $exp */
            return $exp->isNull('sent');
        });
    }

    /**
     * Hashes the password before save
     *
     * @param string $emailGenerationCode The Type & SubType of Token to Make
     *
     * @return false|int
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function make($emailGenerationCode)
    {
        $exists = $this->exists(['email_generation_code' => $emailGenerationCode]);

        $generationArray = explode('-', $emailGenerationCode, 3);

        $type = $generationArray[0];
        $entityId = $generationArray[1];
        $subType = $generationArray[2];

        $existExempt = ['RSV-VIE', 'USR-PWD'];
        $notiTypeCode = $type . '-' . $subType;
        if ($exists && !in_array($notiTypeCode, $existExempt)) {
            return false;
        }

        if (in_array($notiTypeCode, $existExempt)) {
            $iterationNum = 0;
            $newCode = $emailGenerationCode;

            while ($exists) {
                $iterationNum += 1;
                $newCode = $emailGenerationCode . '-' . $iterationNum;
                $exists = $this->exists(['email_generation_code' => $newCode]);
            }
            $emailGenerationCode = $newCode;
        }

        $includeToken = true;
        $includeNotification = true;

        switch ($type) {
            case 'RSV':
                /** @var \App\Model\Entity\Reservation $reservation */
                $reservation = $this->Users->Reservations->get($entityId, ['contain' => 'Users']);
                $layout = 'reservation';

                $userId = $reservation->user->id;
                $redirect = [
                    'controller' => 'Reservations',
                    'action' => 'view',
                    'prefix' => 'parent',
                    $reservation->id
                ];
                $authenticate = true;

                switch ($subType) {
                    case 'NEW':
                        $subject = 'Reservation Confirmation ' . $reservation->reservation_number;
                        $source = 'User';
                        break;
                    case 'CNF':
                        $subject = 'Payment Received for Reservation ' . $reservation->reservation_number;
                        $source = 'Admin';
                        break;
                    case 'EXP':
                        $subject = 'Reservation ' . $reservation->reservation_number . ' has Expired';
                        $source = 'System';
                        break;
                    case 'CAN':
                        $subject = 'Reservation ' . $reservation->reservation_number . ' has been Cancelled';
                        $source = 'Admin';
                        break;
                    case 'R5D':
                        $subject = 'Reservation ' . $reservation->reservation_number . ' Expires Soon';
                        $source = 'System';
                        break;
                    case 'R2D':
                        $subject = 'Reservation ' . $reservation->reservation_number . ' Expires Soon';
                        $source = 'System';
                        break;
                    case 'VIE':
                        $subject = 'View Reservation ' . $reservation->reservation_number . '.';
                        $source = 'Admin';
                        $includeNotification = false;
                        break;
                    default:
                        return false;
                }
                break;
            case 'USR':
                $user = $this->Users->get($entityId);
                $userId = $entityId;
                $authenticate = true;

                switch ($subType) {
                    case 'PWD':
                        $layout = 'password_reset';
                        $subject = 'Password Reset for ' . $user->full_name;
                        $source = 'User';

                        $redirect = [
                            'controller' => 'Users',
                            'action' => 'token',
                            'prefix' => false,
                        ];
                        break;
                    default:
                        return false;
                }

                break;
            default:
                return false;
        }

        $notificationTypeID = $this->NotificationTypes->getTypeCode($type, $subType);

        $data = [
            'email_generation_code' => $emailGenerationCode,
            'sent' => null,
            'user_id' => $userId,
            'subject' => $subject,
            'email_template' => $layout,
            'include_token' => $includeToken,
        ];

        if ($includeNotification) {
            $notificationData = [
                'notification_type_id' => $notificationTypeID,
                'notification' => [
                    'notification_header' => $subject,
                    'notification_type_id' => $notificationTypeID,
                    'user_id' => $userId,
                    'new' => true,
                    'notification_source' => $source,
                ],
            ];
            $data = array_merge($data, $notificationData);
        }

        if ($includeToken) {
            $tokenData = [
                'tokens' => [
                    [
                        'token' => 'Token for ' . $subject,
                        'token_header' => [
                            'redirect' => $redirect,
                            'authenticate' => $authenticate,
                        ]
                    ]
                ]
            ];
            $data = array_merge($data, $tokenData);
        }

        $sendEntity = $this->newEntity($data);

        if ($this->save($sendEntity, ['associated' => ['Tokens', 'Notifications']])) {
            return $sendEntity->id;
        }
    }

    /**
     * Dispatches the Email using the Mailer
     *
     * @param int $emailSendId The ID of the Email Send
     *
     * @return bool
     */
    public function send($emailSendId)
    {
        if (!$this->exists(['id' => $emailSendId])) {
            return false;
        }
        $email = $this->get($emailSendId, ['contain' => ['Tokens', 'Users']]);

        $token = null;

        if ($email->include_token) {
            $token = $email->tokens[0];
            $token = $this->Tokens->buildToken($token->id);
        }

        $generationArray = explode('-', $email->email_generation_code);

        $type = $generationArray[0];
        $entityId = $generationArray[1];

        switch ($type) {
            case 'USR':
                $entity = $this->Users->get($entityId);
                break;
            case 'RSV':
                $entity = $this->Users->Reservations->get($entityId, ['contain' => ['ReservationStatuses']]);
                break;
            default:
                $entity = null;
        }

        /** @var \App\Mailer\BasicMailer $mailer */
        $mailer = $this->getMailer('Basic');
        $mailer->send('basic', [$email, $token, $entity]);

        $email->set('sent', FrozenTime::now());
        $this->save($email, ['validate' => false]);

        return true;
    }

    /**
     * Makes an Email Dispatch Event and then despatches it.
     *
     * @param string $emailGenerationCode The Type & SubType of Token to Make
     *
     * @return bool
     */
    public function makeAndSend($emailGenerationCode)
    {
        $emailSend = $this->make($emailGenerationCode);

        if ($emailSend == false) {
            return false;
        }

        if ($this->send($emailSend)) {
            return true;
        }

        return false;
    }

    /**
     * Makes an Email Dispatch Event and then dispatches it.
     *
     * @param \stdClass $results The Returned Results Array
     * @param array $sendHeaders The Send Headers
     *
     * @return bool
     */
    public function sendRegister($results, $sendHeaders)
    {
        if (!key_exists('X-Gen-ID', $sendHeaders)) {
            $emailSend = $this->newEntity();
        } else {
            $emailSend = $this->get($sendHeaders['X-Gen-ID']);
        }

        $emailSend->set('message_send_code', $results->id);
        $emailSend->set('sent', FrozenTime::now());

        $this->save($emailSend);

        return true;
    }
}
