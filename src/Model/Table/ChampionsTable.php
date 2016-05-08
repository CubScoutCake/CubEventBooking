<?php
namespace App\Model\Table;

use App\Model\Entity\Champion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Champions Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Attendees
 */
class ChampionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('champions');
        $this->displayField('firstname');
        $this->primaryKey('id');

        $this->addBehavior('Muffin/Trash.Trash', [
            'field' => 'deleted'
        ]);

        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');

        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');

        $validator
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['champion']));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
