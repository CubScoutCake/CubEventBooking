<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventStatuses Model
 *
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\HasMany $Events
 *
 * @method \App\Model\Entity\EventStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventStatus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class EventStatusesTable extends Table
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

        $this->setTable('event_statuses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Events', [
            'foreignKey' => 'event_status_id'
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
            ->scalar('event_status')
            ->maxLength('event_status', 255)
            ->requirePresence('event_status', 'create')
            ->notEmpty('event_status');

        $validator
            ->boolean('live')
            ->requirePresence('live', 'create')
            ->notEmpty('live');

        $validator
            ->boolean('accepting_applications')
            ->requirePresence('accepting_applications', 'create')
            ->notEmpty('accepting_applications');

        return $validator;
    }

    /**
     * install the application status config
     *
     * @return mixed
     */
    public function installBaseStatuses()
    {
        $base = Configure::read('eventStatuses');

        $total = 0;

        foreach ($base as $baseStatus) {
            $status = $this->newEntity($baseStatus);
            if ($this->save($status)) {
                $total += 1;
            };
        }

        return $total;
    }
}
