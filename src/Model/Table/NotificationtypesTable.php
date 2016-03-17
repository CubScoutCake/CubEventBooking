<?php
namespace App\Model\Table;

use App\Model\Entity\Notificationtype;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notificationtypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Notifications
 */
class NotificationtypesTable extends Table
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

        $this->table('notificationtypes');
<<<<<<< HEAD
        $this->displayField('id');
=======
        $this->displayField('notification_type');
>>>>>>> master
        $this->primaryKey('id');

        $this->hasMany('Notifications', [
            'foreignKey' => 'notificationtype_id'
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
            ->allowEmpty('notification_type');

        $validator
            ->allowEmpty('notification_description');

<<<<<<< HEAD
        $validator
            ->allowEmpty('icon');

=======
>>>>>>> master
        return $validator;
    }
}
