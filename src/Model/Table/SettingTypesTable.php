<?php
namespace App\Model\Table;

use App\Model\Entity\Settingtype;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settingtypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Settings
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

        $this->table('setting_types');
        $this->displayField('setting_type');
        $this->primaryKey('id');

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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('setting_type', 'create')
            ->notEmpty('setting_type');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
}
