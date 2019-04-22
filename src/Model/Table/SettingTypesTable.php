<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SettingTypes Model
 *
 * @property \App\Model\Table\SettingsTable|\Cake\ORM\Association\HasMany $Settings
 *
 * @method \App\Model\Entity\SettingType get($primaryKey, $options = [])
 * @method \App\Model\Entity\SettingType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SettingType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SettingType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SettingType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SettingType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SettingType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SettingType findOrCreate($search, callable $callback = null, $options = [])
 */
class SettingTypesTable extends Table
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

        $this->setTable('setting_types');
        $this->setDisplayField('setting_type');
        $this->setPrimaryKey('id');

        $this->hasMany('Settings', [
            'foreignKey' => 'setting_type_id'
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
            ->scalar('setting_type')
            ->maxLength('setting_type', 45)
            ->requirePresence('setting_type', 'create')
            ->allowEmptyString('setting_type', false);

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->integer('min_auth')
            ->requirePresence('min_auth', 'create')
            ->allowEmptyString('min_auth', false);

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
        $rules->add($rules->isUnique(['setting_type']));

        return $rules;
    }
}
