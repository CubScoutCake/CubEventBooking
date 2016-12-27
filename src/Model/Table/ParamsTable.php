<?php
namespace App\Model\Table;

use App\Model\Entity\Param;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Params Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Parameters
 * @property \Cake\ORM\Association\HasMany $LogisticItems
 */
class ParamsTable extends Table
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

        $this->table('params');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Parameters', [
            'foreignKey' => 'parameter_id'
        ]);
        $this->hasMany('LogisticItems', [
            'foreignKey' => 'param_id'
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
            ->allowEmpty('constant');

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
        $rules->add($rules->existsIn(['parameter_id'], 'Parameters'));

        return $rules;
    }
}
