<?php
namespace App\Model\Table;

use App\Model\Entity\Scoutgroup;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Scoutgroups Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Districts
 * @property \Cake\ORM\Association\HasMany $Applications
 * @property \Cake\ORM\Association\HasMany $Attendees
 * @property \Cake\ORM\Association\HasMany $Users
 */
class ScoutgroupsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('scoutgroups');
        $this->displayField('scoutgroup');
        $this->primaryKey('id');
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'scoutgroup_id'
        ]);
        $this->hasMany('Attendees', [
            'foreignKey' => 'scoutgroup_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'scoutgroup_id'
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
            ->requirePresence('scoutgroup', 'create')
            ->notEmpty('scoutgroup');

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
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        return $rules;
    }
}
