<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Auth\DigestAuthenticate;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\AuthRolesTable|\Cake\ORM\Association\BelongsTo $AuthRoles
 * @property \App\Model\Table\PasswordStatesTable|\Cake\ORM\Association\BelongsTo $PasswordStates
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\HasMany $Applications
 * @property \App\Model\Table\AttendeesTable|\Cake\ORM\Association\HasMany $Attendees
 * @property \App\Model\Table\ChampionsTable|\Cake\ORM\Association\HasMany $Champions
 * @property \App\Model\Table\EmailSendsTable|\Cake\ORM\Association\HasMany $EmailSends
 * @property \App\Model\Table\InvoicesTable|\Cake\ORM\Association\HasMany $Invoices
 * @property \App\Model\Table\NotesTable|\Cake\ORM\Association\HasMany $Notes
 * @property \App\Model\Table\NotificationsTable|\Cake\ORM\Association\HasMany $Notifications
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 * @property \App\Model\Table\TokensTable|\Cake\ORM\Association\HasMany $Tokens
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('full_name');
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
        $this->addBehavior('Search.Search');
        $this->addBehavior('CounterCache', [
            'Sections' => [
                'cc_users'
            ]
        ]);

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('AuthRoles', [
            'foreignKey' => 'auth_role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PasswordStates', [
            'foreignKey' => 'password_state_id'
        ]);
        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Attendees', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Champions', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('EmailSends', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Notifications', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Tokens', [
            'foreignKey' => 'user_id'
        ]);

        $this->searchManager()
             ->value('section_id')
            // Here we will alias the 'q' query param to search the `Articles.title`
            // field and the `Articles.content` field, using a LIKE match, with `%`
            // both before and after.
             ->value('role_id')
             ->value('auth_role_id')
             ->add('q', 'Search.Like', [
                 'before' => true,
                 'after' => true,
                 'fieldMode' => 'OR',
                 'comparison' => 'ILIKE',
                 'wildcardAny' => '*',
                 'wildcardOne' => '?',
                 'field' => ['firstname', 'lastname', 'email', 'username']
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
            ->scalar('firstname')
            ->maxLength('firstname', 125)
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 125)
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->minLength('password', 6)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 12)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->scalar('address_1')
            ->maxLength('address_1', 255)
            ->requirePresence('address_1', 'create')
            ->notEmpty('address_1');

        $validator
            ->scalar('address_2')
            ->maxLength('address_2', 255)
            ->allowEmpty('address_2');

        $validator
            ->scalar('city')
            ->maxLength('city', 125)
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->scalar('county')
            ->maxLength('county', 125)
            ->requirePresence('county', 'create')
            ->notEmpty('county');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 8)
            ->requirePresence('postcode', 'create')
            ->notEmpty('postcode');

        $validator
            ->scalar('username')
            ->maxLength('username', 45)
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('osm_secret')
            ->maxLength('osm_secret', 255)
            ->allowEmpty('osm_secret');

        $validator
            ->integer('osm_linked')
            ->allowEmpty('osm_linked');

        $validator
            ->dateTime('osm_linkdate')
            ->allowEmpty('osm_linkdate');

        $validator
            ->integer('osm_current_term')
            ->allowEmpty('osm_current_term');

        $validator
            ->dateTime('osm_term_end')
            ->allowEmpty('osm_term_end');

        $validator
            ->scalar('pw_reset')
            ->maxLength('pw_reset', 255)
            ->allowEmpty('pw_reset');

        $validator
            ->dateTime('last_login')
            ->allowEmpty('last_login');

        $validator
            ->integer('logins')
            ->allowEmpty('logins');

        $validator
            ->boolean('validated')
            ->allowEmpty('validated');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->scalar('digest_hash')
            ->maxLength('digest_hash', 255)
            ->allowEmpty('digest_hash');

        $validator
            ->scalar('pw_salt')
            ->maxLength('pw_salt', 255)
            ->allowEmpty('pw_salt');

        $validator
            ->scalar('api_key_plain')
            ->maxLength('api_key_plain', 999)
            ->allowEmpty('api_key_plain');

        $validator
            ->scalar('api_key')
            ->maxLength('api_key', 999)
            ->allowEmpty('api_key');

        $validator
            ->integer('membership_number')
            ->requirePresence('membership_number')
            ->notEmpty('membership_number');

        $validator
            ->boolean('section_validated')
            ->allowEmpty('section_validated');

        $validator
            ->boolean('email_validated')
            ->allowEmpty('email_validated');

        $validator
            ->boolean('simple_attendees')
            ->allowEmpty('simple_attendees');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['membership_number']));

        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['auth_role_id'], 'AuthRoles'));
        $rules->add($rules->existsIn(['password_state_id'], 'PasswordStates'));
        $rules->add($rules->existsIn(['section_id'], 'Sections'));

        return $rules;
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

        // Make a password for digest auth.
        $entity->digest_hash = DigestAuthenticate::password(
            $entity->username,
            'Rho9Sigma',
            env('SERVER_NAME')
        );

        $authRole = $this->AuthRoles->get($entity->auth_role_id);
        $superUser = bindec('10000');

        if ($authRole->auth_value >= $superUser && $entity->isNew()) {
            $hasher = new DefaultPasswordHasher();

            // Generate an API 'token'
            $entity->api_key_plain = sha1(Text::uuid());

            // Bcrypt the token so BasicAuthenticate can check
            // it during login.
            $entity->api_key = $hasher->hash($entity->api_key_plain);
        }

        return true;
    }

    /**
     * Stores emails as lower case.
     *
     * @param \Cake\Event\Event $event The event being processed.
     * @return bool
     */
    public function beforeRules(Event $event)
    {
        $entity = $event->data['entity'];

        $entity->email = strtolower($entity->email);
        $entity->firstname = ucwords(strtolower($entity->firstname));
        $entity->lastname = ucwords(strtolower($entity->lastname));
        $entity->address_1 = ucwords(strtolower($entity->address_1));
        $entity->address_2 = ucwords(strtolower($entity->address_2));
        $entity->city = ucwords(strtolower($entity->city));
        $entity->county = ucwords(strtolower($entity->county));
        $entity->postcode = strtoupper($entity->postcode);

        return true;
    }
}
