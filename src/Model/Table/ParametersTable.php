<?php
namespace App\Model\Table;

use App\Model\Entity\Parameter;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parameters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParameterSets
 * @property \Cake\ORM\Association\HasMany $Logistics
 * @property \Cake\ORM\Association\HasMany $Params
 */
class ParametersTable extends Table
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

        $this->table('parameters');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);

        $this->belongsTo('ParameterSets', [
            'foreignKey' => 'set_id'
        ]);
        $this->hasMany('Logistics', [
            'foreignKey' => 'parameter_id'
        ]);
        $this->hasMany('Params', [
            'foreignKey' => 'parameter_id'
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
            ->allowEmpty('parameter');

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
        $rules->add($rules->existsIn(['set_id'], 'ParameterSets'));

        return $rules;
    }
}
