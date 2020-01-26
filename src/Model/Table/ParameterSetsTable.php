<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParameterSets Model
 *
 * @method \App\Model\Entity\ParameterSet get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParameterSet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ParameterSet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParameterSet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParameterSet|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParameterSet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParameterSet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParameterSet findOrCreate($search, callable $callback = null, $options = [])
 */
class ParameterSetsTable extends Table
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

        $this->setTable('parameter_sets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        return $validator;
    }
}
