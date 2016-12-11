<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttendeesAllergies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Attendees
 * @property \Cake\ORM\Association\BelongsTo $Allergies
 *
 * @method \App\Model\Entity\AttendeesAllergy get($primaryKey, $options = [])
 * @method \App\Model\Entity\AttendeesAllergy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AttendeesAllergy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttendeesAllergy|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttendeesAllergy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AttendeesAllergy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttendeesAllergy findOrCreate($search, callable $callback = null)
 */
class AttendeesAllergiesTable extends Table
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

        $this->table('attendees_allergies');
        $this->displayField('attendee_id');
        $this->primaryKey(['attendee_id', 'allergy_id']);

        $this->belongsTo('Attendees', [
            'foreignKey' => 'attendee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Allergies', [
            'foreignKey' => 'allergy_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['attendee_id'], 'Attendees'));
        $rules->add($rules->existsIn(['allergy_id'], 'Allergies'));

        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'hertcubdev';
    }
}
