<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Allergies Model
 *
 * @property \App\Model\Table\AttendeesTable|\Cake\ORM\Association\BelongsToMany $Attendees
 *
 * @method \App\Model\Entity\Allergy get($primaryKey, $options = [])
 * @method \App\Model\Entity\Allergy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Allergy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Allergy|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Allergy|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Allergy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Allergy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Allergy findOrCreate($search, callable $callback = null, $options = [])
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

        $this->setTable('allergies');
        $this->setDisplayField('allergy');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Attendees', [
            'through' => 'AttendeesAllergies',
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
            ->scalar('allergy')
            ->maxLength('allergy', 255)
            ->requirePresence('allergy', 'create')
            ->allowEmptyString('allergy', false);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->boolean('is_medical')
            ->requirePresence('is_medical', 'create')
            ->allowEmptyString('is_medical', false);

        $validator
            ->boolean('is_specific')
            ->allowEmptyString('is_specific', false);

        $validator
            ->boolean('is_dietary')
            ->requirePresence('is_dietary', 'create')
            ->allowEmptyString('is_dietary', false);

        return $validator;
    }

    /**
     * Medical Finder Method
     *
     * @param \Cake\ORM\Query $query The Query to be altered
     *
     * @return \Cake\ORM\Query
     */
    public function findMedical($query)
    {
        return $query->where(['is_medical' => true]);
    }

    /**
     * Dietary Finder Method
     *
     * @param \Cake\ORM\Query $query The Query to be altered
     *
     * @return \Cake\ORM\Query
     */
    public function findDietary($query)
    {
        return $query->where(['is_dietary' => true]);
    }

    /**
     * Non Specific Finder Method
     *
     * @param \Cake\ORM\Query $query The Query to be altered
     *
     * @return \Cake\ORM\Query
     */
    public function findNonSpecific($query)
    {
        return $query->where(['is_specific' => false]);
    }

    /**
     * Callback to always return rows that have not been `trashed`.
     *
     * @param \Cake\Event\Event $event Event processed.
     * @param \Cake\ORM\Query $query Query.
     * @param \ArrayObject $options Options.
     * @param bool $primary Primary or associated table being queries.
     * @return void
     */
    public function beforeFind($event, $query, $options, $primary)
    {
        $query = $this->findNonSpecific($query);
    }
}
