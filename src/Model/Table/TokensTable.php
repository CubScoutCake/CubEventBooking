<?php
namespace App\Model\Table;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Security;
use Cake\Validation\Validator;

/**
 * Tokens Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $EmailSends
 *
 * @method \App\Model\Entity\Token get($primaryKey, $options = [])
 * @method \App\Model\Entity\Token newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Token[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Token|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Token patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Token[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Token findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TokensTable extends Table
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

        $this->setTable('tokens');
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
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EmailSends', [
            'foreignKey' => 'email_send_id',
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
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->dateTime('expires')
            ->allowEmpty('expires');

        $validator
            ->dateTime('utilised')
            ->allowEmpty('utilised');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create');

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
        $rules->add($rules->existsIn(['email_send_id'], 'EmailSends'));

        return $rules;
    }

    /**
     *
     * @param Event       $event The Event to be processed
     * @param ArrayObject $data The data to be modified
     * @param ArrayObject $options The Options Contained
     *
     * @return void
     */
    public function beforeMarshal(Event $event, $data, $options)
    {
        if (!isset($data['active'])) {
            // Sets Active
            $data['active'] = true;
        }
    }

    /**
     * Hashes the password before save
     *
     * @param \Cake\Event\Event $event The event trigger.
     * @return true
     */
    public function beforeSave(Event $event)
    {
        $entity = $event->data['entity'];

        if ($entity->isNew()) {
            $entity->random_number = random_int(
                1000000,
                9999999
            );

            // Set Expiry Date
            $now = Time::now();
            $entity->expires = $now->addMonth(1);
        }

        return true;
    }

    /**
     * @param int $tokenId The Id of the Token
     *
     * @return string
     */
    public function buildToken($tokenId)
    {
        $tokenRow = $this->get($tokenId, [
            'contain' => 'Users'
        ]);

        $decrypter = Security::randomBytes(256);

        $hash = $decrypter . $tokenRow->user->lastname . $tokenRow->created . $tokenRow['random_number'];

        $hash = Security::hash($hash, 'sha256');

        $hashData = [
            'hash' => $hash
        ];

        $this->patchEntity($tokenRow, $hashData);

        $this->save($tokenRow);

        $tokenData = [
            'id' => $tokenId,
            'random_number' => $tokenRow['random_number'],
        ];

        $token = json_encode($tokenData);
        $token = base64_encode($token);

        $token = $decrypter . $token;
        $token = urlencode($token);

        return $token;
    }

    /**
     * @param string $token The Token to be Validated & Decrypted
     *
     * @return int|bool $validation Containing the validation state & id
     */
    public function validate($token)
    {
        $token = urldecode($token);
        $decrypter = substr($token, 0, 256);

        $token = substr($token, 256);
        $token = base64_decode($token);
        $token = json_decode($token);

        $tokenRow = $this->get($token['id'], [
            'contain' => 'Users'
        ]);

        if ($tokenRow['random_number'] <> $token['random_number']) {
            return false;
        }

        $testHash = $decrypter . $tokenRow->user->lastname . $tokenRow->created . $tokenRow['random_number'];
        $testHash = Security::hash($testHash, 'sha256');

        $tokenRowHash = $tokenRow['hash'];

        if ($testHash === $tokenRowHash) {
            return $token['id'];
        }

        return false;
    }
}
