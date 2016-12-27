<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicationsAttendees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Applications
 * @property \Cake\ORM\Association\BelongsTo $Attendees
 *
 * @method \App\Model\Entity\ApplicationsAttendee get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApplicationsAttendee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApplicationsAttendee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationsAttendee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicationsAttendee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationsAttendee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationsAttendee findOrCreate($search, callable $callback = null)
 */
class ApplicationsAttendeesTable extends Table
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

        $this->table('applications_attendees');
        $this->displayField('application_id');
        $this->primaryKey(['application_id', 'attendee_id']);

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Attendees', [
            'foreignKey' => 'attendee_id',
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
        $rules->add($rules->existsIn(['application_id'], 'Applications'));
        $rules->add($rules->existsIn(['attendee_id'], 'Attendees'));

        return $rules;
    }
}
