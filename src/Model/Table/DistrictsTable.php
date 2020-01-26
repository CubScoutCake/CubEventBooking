<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Districts Model
 *
 * @property \App\Model\Table\ChampionsTable|\Cake\ORM\Association\HasMany $Champions
 * @property \App\Model\Table\ScoutgroupsTable|\Cake\ORM\Association\HasMany $Scoutgroups
 *
 * @method \App\Model\Entity\District get($primaryKey, $options = [])
 * @method \App\Model\Entity\District newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\District[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\District|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\District saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\District patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\District[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\District findOrCreate($search, callable $callback = null, $options = [])
 */
class DistrictsTable extends Table
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

        $this->setTable('districts');
        $this->setDisplayField('district');
        $this->setPrimaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted',
        ]);

        $this->hasMany('Scoutgroups', [
            'foreignKey' => 'district_id',
        ]);
        $this->hasMany('Champions', [
            'foreignKey' => 'district_id',
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
            ->scalar('district')
            ->maxLength('district', 255)
            ->requirePresence('district', 'create')
            ->allowEmptyString('district', false)
            ->add('district', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('county')
            ->maxLength('county', 255)
            ->allowEmptyString('county');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        $validator
            ->scalar('short_name')
            ->maxLength('short_name', 16)
            ->allowEmptyString('short_name');

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
        $rules->add($rules->isUnique(['district']));

        return $rules;
    }
}
