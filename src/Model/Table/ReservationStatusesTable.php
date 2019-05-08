<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReservationStatuses Model
 *
 * @property \App\Model\Table\ReservationsTable|\Cake\ORM\Association\HasMany $Reservations
 *
 * @method \App\Model\Entity\ReservationStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReservationStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReservationStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReservationStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class ReservationStatusesTable extends Table
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

        $this->setTable('reservation_statuses');
        $this->setDisplayField('reservation_status');
        $this->setPrimaryKey('id');

        $this->hasMany('Reservations', [
            'foreignKey' => 'reservation_status_id'
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
            ->scalar('reservation_status')
            ->maxLength('reservation_status', 255)
            ->requirePresence('reservation_status', 'create')
            ->allowEmptyString('reservation_status', false);

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        $validator
            ->boolean('complete')
            ->requirePresence('complete', 'create')
            ->allowEmptyString('complete', false);

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
        $rules->add($rules->isUnique(['reservation_status']));

        return $rules;
    }

    /**
     * install the application status config
     *
     * @return mixed
     */
    public function installBaseStatuses()
    {
        $base = Configure::read('reservationStatuses');

        $total = 0;

        foreach ($base as $baseStatus) {
            $query = $this->find()->where(['reservation_status' => 'reservation_status']);
            $status = $this->newEntity();
            if ($query->count() > 0) {
                $status = $query->first();
            }
            $this->patchEntity($status, $baseStatus);
            if ($this->save($status)) {
                $total += 1;
            };
        }

        return $total;
    }
}
