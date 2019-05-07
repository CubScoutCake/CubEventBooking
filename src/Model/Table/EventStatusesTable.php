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
 * @method \App\Model\Entity\EventStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
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
        $this->setDisplayField('event_status');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('event_status')
            ->requirePresence('event_status', 'create')
            ->maxLength('event_status', 255)
            ->add('event_status', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->allowEmptyString('event_status', false);

        $validator
            ->boolean('live')
            ->allowEmptyString('live');

        $validator
            ->boolean('accepting_applications')
            ->allowEmptyString('accepting_applications');

        $validator
            ->boolean('spaces_full')
            ->allowEmptyString('spaces_full');

        $validator
            ->boolean('pending_date')
            ->allowEmptyString('pending_date');

        $validator
            ->integer('status_order')
            ->allowEmptyString('status_order', false);

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
            $status = $this->findOrCreate($baseStatus);
            if ($this->save($status)) {
                $total += 1;
            };
        }

        return $total;
    }
}
