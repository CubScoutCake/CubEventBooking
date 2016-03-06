<?php
namespace App\Model\Table;

use App\Model\Entity\Discount;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Discounts Model
 *
 * @property \Cake\ORM\Association\HasMany $Events
 */
class DiscountsTable extends Table
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

        $this->table('discounts');
        $this->displayField('discount');
        $this->primaryKey('id');

        $this->hasMany('Events', [
            'foreignKey' => 'discount_id'
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
            ->allowEmpty('discount');

        $validator
            ->allowEmpty('code');

        $validator
            ->allowEmpty('text');

        $validator
            ->add('active', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('active');

        $validator
            ->add('discount_value', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('discount_value');

        $validator
            ->add('discount_number', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('discount_number');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['code']));
        return $rules;
    }
}
