<?php
namespace App\Model\Table;

use App\Model\Entity\Application;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Applications Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\BelongsTo $Sections
 * @property \App\Model\Table\ApplicationStatusesTable|\Cake\ORM\Association\BelongsTo $ApplicationStatuses
 * @property \App\Model\Table\InvoicesTable|\Cake\ORM\Association\HasOne $Invoices
 * @property \App\Model\Table\LogisticItemsTable|\Cake\ORM\Association\HasMany $LogisticItems
 * @property \App\Model\Table\NotesTable|\Cake\ORM\Association\HasMany $Notes
 * @property \App\Model\Table\AttendeesTable|\Cake\ORM\Association\BelongsToMany $Attendees
 *
 * @method \App\Model\Entity\Application get($primaryKey, $options = [])
 * @method \App\Model\Entity\Application newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Application[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Application|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Application saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Application patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Application[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Application findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApplicationsTable extends Table
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

        $this->setTable('applications');
        $this->setDisplayField('display_code');
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

        $this->addBehavior('SectionAuth');

        $this->addBehavior('CounterCache', [
            'Events' => [
                'cc_apps'
            ],
            'Sections' => [
                'cc_apps'
            ]
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
        ]);
        $this->belongsTo('ApplicationStatuses', [
            'foreignKey' => 'application_status_id',
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasOne('Invoices', [
                'foreignKey' => 'application_id',
            ])
            ->setDependent(true)
            ->setCascadeCallbacks(true);

        $this->hasMany('LogisticItems', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'application_id'
        ]);
        $this->belongsToMany('Attendees', [
            'through' => 'ApplicationsAttendees',
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
            ->scalar('permit_holder')
            ->maxLength('permit_holder', 255)
            ->allowEmptyString('permit_holder');

        $validator
            ->integer('cc_inv_leaders')
            ->allowEmptyString('cc_inv_leaders');

        $validator
            ->scalar('team_leader')
            ->maxLength('team_leader', 255)
            ->allowEmptyString('team_leader');

        $validator
            ->allowEmptyString('hold_numbers');

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
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        $rules->add($rules->existsIn(['section_id'], 'Sections'));
        $rules->add($rules->existsIn(['application_status_id'], 'ApplicationStatuses'));

        return $rules;
    }

    /**
     * Ownership test function for Authentication.
     *
     * @param int $applicationId The Application Id to be checked.
     * @param int $userId The asserted User.
     * @return bool
     */
    public function isOwnedBy($applicationId, $userId)
    {
        return $this->exists(['id' => $applicationId, 'user_id' => $userId]);
    }

    /**
     * Finds the applications owned by the user.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options An array containing the user to be searched for.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findOwnedBy($query, $options)
    {
        $userId = $options['userId'];

        return $query->where(['Applications.user_id' => $userId]);
    }

    /**
     * Finds the applications that are not for an archived event.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @return \Cake\ORM\Query The modified query.
     */
    public function findUnarchived($query)
    {
        return $query->contain('Events.EventStatuses')->where(['EventStatuses.live' => true]);
    }

    /**
     * Finds the attendees, which are Cubs on the Application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options The Array containing Options
     *
     * @return \Cake\ORM\Query The modified query.
     */
    public function findSection($query, $options)
    {
        $roleId = 3;
        if (key_exists('role_id', $options)) {
            $roleId = $options['role_id'];
        }

        switch ($roleId) {
            case 1:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where([
                            'Attendees.deleted IS' => null,
                            'Roles.minor' => true,
                            'Roles.id' => 1
                        ]);
                    }
                );
                break;
            case 2:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where([
                            'Attendees.deleted IS' => null,
                            'Roles.minor' => true,
                            'Roles.id' => 2
                        ]);
                    }
                );
                break;
            case 3:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where([
                            'Attendees.deleted IS' => null,
                            'Roles.minor' => true,
                            'Roles.id' => 3
                        ]);
                    }
                );
                break;

            case 4:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where([
                            'Attendees.deleted IS' => null,
                            'Roles.minor' => true,
                            'Roles.id' => 4
                        ]);
                    }
                );
                break;

            default:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where([
                            'Attendees.deleted IS' => null,
                            'Roles.minor' => true,
                            'Roles.id' => 3
                        ]);
                    }
                );
        }

        return $query;
    }

    /**
     * Finds the attendees, which are Young Leaders on the Application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param array $options The Array containing Options.
     *
     * @return \Cake\ORM\Query The modified query.
     */
    public function findNonSection($query, $options)
    {
        $roleId = 3;
        if (key_exists('role_id', $options)) {
            $roleId = $options['role_id'];
        }

        switch ($roleId) {
            case 1:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => true, 'Roles.id <>' => 1]);
                    }
                );
                break;
            case 2:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => true, 'Roles.id <>' => 2]);
                    }
                );
                break;
            case 3:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => true, 'Roles.id <>' => 3]);
                    }
                );
                break;

            case 4:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => true, 'Roles.id <>' => 4]);
                    }
                );
                break;

            default:
                $query = $query->matching(
                    'Attendees.Roles',
                    function ($q) {
                        return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => true, 'Roles.id <>' => 3]);
                    }
                );
        }

        return $query;
    }

    /**
     * Finds the attendees, which are Adult Leaders on the Application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     *
     * @return \Cake\ORM\Query The modified query.
     */
    public function findLeaders($query)
    {
        $query = $query->matching(
            'Attendees.Roles',
            function ($q) {
                return $q->where(['Attendees.deleted IS' => null, 'Roles.minor' => false]);
            }
        );

        return $query;
    }

    /**
     * Finds the attendees, which are Adult Leaders on the Application.
     *
     * @param \Cake\ORM\Query $query The original query to be modified.
     * @param int $roleId The Role ID to be Searched For
     *
     * @return \Cake\ORM\Query The modified query.
     */
    public function findRoles($query, $roleId)
    {
        $query = $query->matching(
            'Attendees.Roles',
            function ($q) {
                return $q->where(['Attendees.deleted IS' => null, 'Roles.id' => $roleId]);
            }
        );

        return $query;
    }

    /*public function isChampedBy($applicationId, $userId)
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');
        $users = TableRegistry::get('Users');

        $user = $users->get($userId, ['contain' => 'Scoutgroups'])->Scoutgroup->district_id;
        $groups = $scoutgroups->find('list', ['conditions' => ['district' => $user]]);

        return $this->existsIn(['id' => $applicationId, 'Scoutgroup' => $userId]);
    }*/
}
