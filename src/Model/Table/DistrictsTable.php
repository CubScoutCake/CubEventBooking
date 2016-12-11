<?php
namespace App\Model\Table;

use App\Model\Entity\District;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Districts Model
 *
 * @property \Cake\ORM\Association\HasMany $Scoutgroups
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
        $this->table('districts');
        $this->displayField('district');
        $this->primaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);
        
        $this->hasMany('Scoutgroups', [
            'foreignKey' => 'district_id'
        ]);
        $this->hasMany('Champions', [
            'foreignKey' => 'district_id'
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
            ->requirePresence('district', 'create')
            ->notEmpty('district');
            
        $validator
            ->allowEmpty('county');

        return $validator;
    }
}
