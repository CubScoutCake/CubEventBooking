<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicationStatuses Model
 *
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\HasMany $Applications
 *
 * @method \App\Model\Entity\ApplicationStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApplicationStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApplicationStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicationStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicationStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplicationStatusesTable extends Table
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

        $this->setTable('application_statuses');
        $this->setDisplayField('application_status');
        $this->setPrimaryKey('id');

        $this->hasMany('Applications', [
            'foreignKey' => 'application_status_id',
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
            ->scalar('application_status')
            ->maxLength('application_status', 255)
            ->requirePresence('application_status', 'create')
            ->add('application_status', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->allowEmptyString('application_status', false);

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active');

        $validator
            ->boolean('no_money')
            ->requirePresence('no_money', 'create')
            ->allowEmptyString('no_money');

        $validator
            ->boolean('reserved')
            ->requirePresence('reserved', 'create')
            ->allowEmptyString('reserved');

        $validator
            ->boolean('attendees_added')
            ->requirePresence('attendees_added', 'create')
            ->allowEmptyString('attendees_added');

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
        $rules->add($rules->isUnique(['application_status']));

        return $rules;
    }

    /**
     * install the application status config
     *
     * @return mixed
     */
    public function installBaseStatuses()
    {
        $base = Configure::read('applicationStatuses');

        $total = 0;

        foreach ($base as $baseStatus) {
            $query = $this->find()->where(['application_status' => $baseStatus['application_status']]);
            $status = $this->newEntity();
            if ($query->count() > 0) {
                $status = $query->first();
            }
            $this->patchEntity($status, $baseStatus);
            if ($this->save($status)) {
                $total += 1;
            }
        }

        return $total;
    }
}
