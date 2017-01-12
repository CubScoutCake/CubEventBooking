<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SectionTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $Sections
 *
 * @method \App\Model\Entity\SectionType get($primaryKey, $options = [])
 * @method \App\Model\Entity\SectionType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SectionType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SectionType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SectionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SectionType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SectionType findOrCreate($search, callable $callback = null)
 */
class SectionTypesTable extends Table
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

        $this->table('section_types');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id'
        ]);
        $this->hasMany('Sections', [
            'foreignKey' => 'section_type_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('section_type', 'create')
            ->notEmpty('section_type');

        $validator
            ->integer('upper_age')
            ->requirePresence('upper_age', 'create')
            ->notEmpty('upper_age');

        $validator
            ->integer('lower_age')
            ->requirePresence('lower_age', 'create')
            ->notEmpty('lower_age');

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
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
