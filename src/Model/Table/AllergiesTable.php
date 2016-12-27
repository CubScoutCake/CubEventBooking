<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Allergies Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Attendees
 *
 * @method \App\Model\Entity\Allergy get($primaryKey, $options = [])
 * @method \App\Model\Entity\Allergy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Allergy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Allergy|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Allergy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Allergy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Allergy findOrCreate($search, callable $callback = null)
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
        parent::initialize($config);

        $this->table('allergies');
        $this->displayField('allergy');
        $this->primaryKey('id');

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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('allergy', 'create')
            ->notEmpty('allergy');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
}
