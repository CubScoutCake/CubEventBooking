<?php
namespace App\Model\Table;

use App\Model\Entity\Allergy;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Allergies Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Attendees
 */
class AllergiesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('allergies');
        $this->displayField('allergy');
        $this->primaryKey('allergy');
        $this->belongsToMany('Attendees', [
            'foreignKey' => 'allergy_id',
            'targetForeignKey' => 'attendee_id',
            'joinTable' => 'attendees_allergies'
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
            ->requirePresence('allergy', 'create')
            ->notEmpty('allergy');
            
        $validator
            ->allowEmpty('description');

        return $validator;
    }
}