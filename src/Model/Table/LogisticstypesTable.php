<?php
namespace App\Model\Table;

use App\Model\Entity\Logisticstype;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logisticstypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Logistics
 */
class LogisticstypesTable extends Table
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

        $this->table('logisticstypes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Logistics', [
            'foreignKey' => 'logisticstype_id'
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
            ->allowEmpty('logistics_type');

        $validator
            ->allowEmpty('type_description');

        return $validator;
    }
}
