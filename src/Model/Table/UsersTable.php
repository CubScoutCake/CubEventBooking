<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use ArrayObject;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Auth\DigestAuthenticate;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Security;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property |\Cake\ORM\Association\BelongsTo $OsmUsers
 * @property |\Cake\ORM\Association\BelongsTo $OsmSections
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
 * @property \App\Model\Table\ReservationsTable|\Cake\ORM\Association\HasMany $Reservations
 * @property \App\Model\Table\TasksTable|\Cake\ORM\Association\HasMany $Tasks
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
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
        $this->hasMany('Reservations', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Tasks', [
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 125)
            ->requirePresence('firstname', 'create')
            ->allowEmptyString('firstname', false);

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 125)
            ->requirePresence('lastname', 'create')
            ->allowEmptyString('lastname', false);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->scalar('phone')
            ->maxLength('phone', 12)
            ->requirePresence('phone', 'create')
            ->allowEmptyString('phone', false);

        $validator
            ->scalar('address_1')
            ->maxLength('address_1', 255)
            ->requirePresence('address_1', 'create')
            ->allowEmptyString('address_1', false);

        $validator
            ->scalar('address_2')
            ->maxLength('address_2', 255)
            ->allowEmptyString('address_2');

        $validator
            ->scalar('city')
            ->maxLength('city', 125)
            ->requirePresence('city', 'create')
            ->allowEmptyString('city', false);

        $validator
            ->scalar('county')
            ->maxLength('county', 125)
            ->requirePresence('county', 'create')
            ->allowEmptyString('county', false);

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 8)
            ->requirePresence('postcode', 'create')
            ->allowEmptyString('postcode', false);

        $validator
            ->scalar('legacy_section')
            ->maxLength('legacy_section', 255)
            ->allowEmptyString('legacy_section');

        $validator
            ->scalar('username')
            ->maxLength('username', 45)
            ->requirePresence('username', 'create')
            ->allowEmptyString('username', false)
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('osm_secret')
            ->maxLength('osm_secret', 255)
            ->allowEmptyString('osm_secret');

        $validator
            ->integer('osm_linked')
            ->allowEmptyString('osm_linked');

        $validator
            ->dateTime('osm_linkdate')
            ->allowEmptyDateTime('osm_linkdate');

        $validator
            ->integer('osm_current_term')
            ->allowEmptyString('osm_current_term');

        $validator
            ->dateTime('osm_term_end')
            ->allowEmptyDateTime('osm_term_end');

        $validator
            ->scalar('pw_reset')
            ->maxLength('pw_reset', 255)
            ->allowEmptyString('pw_reset');

        $validator
            ->dateTime('last_login')
            ->allowEmptyDateTime('last_login');

        $validator
            ->integer('logins')
            ->allowEmptyString('logins');

        $validator
            ->boolean('validated')
            ->requirePresence('validated', 'create')
            ->allowEmptyString('validated', false);

        $validator
            ->scalar('digest_hash')
            ->maxLength('digest_hash', 255)
            ->allowEmptyString('digest_hash');

        $validator
            ->scalar('pw_salt')
            ->maxLength('pw_salt', 255)
            ->allowEmptyString('pw_salt');

        $validator
            ->scalar('api_key_plain')
            ->maxLength('api_key_plain', 999)
            ->allowEmptyString('api_key_plain');

        $validator
            ->scalar('api_key')
            ->maxLength('api_key', 999)
            ->allowEmptyString('api_key');

        $validator
            ->integer('membership_number')
            ->requirePresence('membership_number', 'create')
            ->allowEmptyString('membership_number', false);

        $validator
            ->integer('simple_attendees')
            ->allowEmptyString('simple_attendees');

        $validator
            ->boolean('member_validated')
            ->requirePresence('member_validated', 'create')
            ->allowEmptyString('member_validated', false);

        $validator
            ->boolean('section_validated')
            ->requirePresence('section_validated', 'create')
            ->allowEmptyString('section_validated', false);

        $validator
            ->boolean('email_validated')
            ->requirePresence('email_validated', 'create')
            ->allowEmptyString('email_validated', false);

        $validator
            ->integer('role_id')
            ->requirePresence('role_id', 'create')
            ->allowEmptyString('role_id', false);

        $validator
            ->integer('auth_role_id')
            ->requirePresence('auth_role_id', 'create')
            ->allowEmptyString('auth_role_id', false);

        $validator
            ->integer('password_state_id')
            ->requirePresence('password_state_id', 'create')
            ->allowEmptyString('password_state_id', false);

        $validator
            ->integer('section_id')
            ->requirePresence('section_id', 'create')
            ->allowEmptyString('section_id', false);

        return $validator;
    }

    /**
     * Parent User Validation
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationParent($validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 125)
            ->requirePresence('firstname', 'create')
            ->allowEmptyString('firstname', false);

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 125)
            ->requirePresence('lastname', 'create')
            ->allowEmptyString('lastname', false);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false)
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->scalar('phone')
            ->maxLength('phone', 12)
            ->requirePresence('phone', 'create')
            ->allowEmptyString('phone', false);

        $validator
            ->scalar('address_1')
            ->maxLength('address_1', 255)
            ->requirePresence('address_1', 'create')
            ->allowEmptyString('address_1', false);

        $validator
            ->scalar('address_2')
            ->maxLength('address_2', 255)
            ->allowEmptyString('address_2');

        $validator
            ->scalar('city')
            ->maxLength('city', 125)
            ->requirePresence('city', 'create')
            ->allowEmptyString('city', false);

        $validator
            ->scalar('county')
            ->maxLength('county', 125)
            ->requirePresence('county', 'create')
            ->allowEmptyString('county', false);

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 8)
            ->requirePresence('postcode', 'create')
            ->allowEmptyString('postcode', false);

        $validator
            ->scalar('username')
            ->maxLength('username', 45)
            ->requirePresence('username', 'create')
            ->allowEmptyString('username', false)
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('role_id')
            ->requirePresence('role_id', 'create')
            ->allowEmptyString('role_id', false);

        $validator
            ->integer('auth_role_id')
            ->requirePresence('auth_role_id', 'create')
            ->allowEmptyString('auth_role_id', false);

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
        /** @var \App\Model\Entity\User $entity */
        $entity = $event->getData('entity');

        // Make a password for digest auth.
        $entity->digest_hash = DigestAuthenticate::password(
            $entity->username,
            'Rho9Sigma',
            env('SERVER_NAME')
        );

        if (is_null($entity->last_login)) {
            $entity->last_login = Time::now();
        }

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
     * @var array The Array for Uppercase Conversion
     */
    public $upperCase = ['postcode'];

    /**
     * @var array The Array for Uppercase Conversion
     */
    public $lowerCase = ['email'];

    /**
     * @var array The Array for Title Case Conversion
     */
    public $initCase = ['firstname', 'lastname', 'address_1', 'address_2', 'city', 'county'];

    /**
     * @param User $entity The Attendee Entity to be Case Fixed
     *
     * @return User
     */
    public function changeCase($entity)
    {
        foreach ($this->initCase as $initValue) {
            $entity = $entity->set($initValue, ucwords(strtolower($entity->get($initValue))));
        }

        foreach ($this->upperCase as $upperValue) {
            $entity = $entity->set($upperValue, strtoupper($entity->get($upperValue)));
        }

        foreach ($this->lowerCase as $initValue) {
            $entity = $entity->set($initValue, strtolower($entity->get($initValue)));
        }

        return $entity;
    }

    /**
     * Stores emails as lower case.
     *
     * @param \Cake\Event\Event $event The event being processed.
     * @return bool
     */
    public function beforeRules(Event $event)
    {
        /** @var \App\Model\Entity\User $entity */
        $entity = $event->getData('entity');

        $entity = $this->changeCase($entity);

        return true;
    }

    /**
     * Before Marshal Transformation
     *
     * @param \Cake\Event\Event $event The Event Data
     * @param \ArrayObject $data Data Array
     * @param \ArrayObject $options Options Array
     *
     * @return bool
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        $toSet = [
            'validated' => false,
            'member_validated' => false,
            'section_validated' => false,
            'email_validated' => false,
        ];

        foreach ($toSet as $key => $value) {
            if (!key_exists($key, $data)) {
                $data[$key] = $value;
            }
        }

        return true;
    }

    /**
     * Finder to locate Parent Accounts
     *
     * @param Query $query the Query to be modified.
     *
     * @return Query
     */
    public function findParents($query)
    {
        return $query
            ->contain('AuthRoles')
            ->where(['AuthRoles.parent_access' => true]);
    }

    /**
     * Finder to locate Access User Accounts
     *
     * @param Query $query the Query to be modified.
     *
     * @return Query
     */
    public function findAccess($query)
    {
        return $query
            ->contain('AuthRoles')
            ->where(['AuthRoles.user_access' => true]);
    }

    /**
     * Function to Detect Parent Accounts
     *
     * @param array $userArray The Array Data sent
     *
     * @return bool|array|\Cake\Datasource\EntityInterface
     */
    public function detectParent($userArray)
    {
        $user = $this->detectExisting($userArray);

        if ($user !== false) {
            /** @var User $user */
            $userId = $user->id;
            $user = $this->get($userId, ['contain' => 'AuthRoles']);

            $user->set('auth_role_id', $this->AuthRoles->parentAuthRole($user->auth_role));
            $user = $this->save($user);
        }

        return $user;
    }

    /**
     * Function to Detect Parent Accounts
     *
     * @param array $userArray The Array Data sent
     *
     * @return bool|array|\Cake\Datasource\EntityInterface
     */
    public function detectExisting($userArray)
    {
        $existingFind = $this->find('all')->where([
            'firstname ILIKE' => $userArray['firstname'],
            'lastname ILIKE' => $userArray['lastname'],
            'OR' => [
                'email ILIKE' => $userArray['email'],
                'postcode ILIKE' => $userArray['postcode'],
            ]
        ]);

        if (!is_null($existingFind->count()) && $existingFind->count() == 1) {
            return $existingFind->first();
        }

        return false;
    }

    /**
     * Function to create a Parent User from Limited Data
     *
     * @param array $userData Request Data for User
     * @param int $sectionId ID of the Section
     *
     * @return bool|User
     */
    public function createParent($userData, $sectionId)
    {
        $userData['username'] = $userData['email'];
        $userData['password'] = Security::randomString(18);

        // AuthRole
        $userData['auth_role_id'] = $this->AuthRoles->parentAuthRole();
        $userData['section_id'] = $sectionId;

        // Parent Role
        $parentRole = $this->Roles->findOrCreate([
            'role' => 'Parent',
            'invested' => false,
            'minor' => false,
            'automated' => false,
            'short_role' => 'Parent',
        ]);
        $userData['role_id'] = $parentRole->id;

        $user = $this->newEntity($userData, ['validate' => 'parent']);

        return $this->save($user);
    }

    /**
     * Function to create a Parent User from Limited Data
     *
     * @param array $userData Request Data for User
     * @param int $sectionId ID of the Section
     *
     * @return bool|User
     */
    public function createOrDetectParent($userData, $sectionId)
    {
        $user = $this->detectParent($userData);

        if ($user !== false) {
            return $user;
        }

        return $this->createParent($userData, $sectionId);
    }
}
