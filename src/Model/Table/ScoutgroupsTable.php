<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Scoutgroups Model
 *
 * @property \App\Model\Table\DistrictsTable|\Cake\ORM\Association\BelongsTo $Districts
 * @property \App\Model\Table\SectionsTable|\Cake\ORM\Association\HasMany $Sections
 *
 * @method \App\Model\Entity\Scoutgroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\Scoutgroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Scoutgroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Scoutgroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Scoutgroup saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Scoutgroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Scoutgroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Scoutgroup findOrCreate($search, callable $callback = null, $options = [])
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
        parent::initialize($config);

        $this->setTable('scoutgroups');
        $this->setDisplayField('scoutgroup');
        $this->setPrimaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);
        $this->addBehavior('Search.Search');

        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
        ]);
        $this->hasMany('Sections', [
            'foreignKey' => 'scoutgroup_id'
        ]);

        $this->searchManager()
            ->value('district_id')
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['scoutgroup']
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
            ->scalar('scoutgroup')
            ->maxLength('scoutgroup', 255)
            ->requirePresence('scoutgroup', 'create')
            ->allowEmptyString('scoutgroup', false)
            ->add('scoutgroup', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('number_stripped')
            ->allowEmptyString('number_stripped');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

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
        $rules->add($rules->isUnique(['scoutgroup']));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));

        return $rules;
    }
}
