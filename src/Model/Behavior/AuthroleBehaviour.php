<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 07/01/2017
 * Time: 20:40
 */
namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;

class AuthroleBehaviour extends Behavior
{
    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
    {
        $entity = $event->data['entity'];

        $user = $this->Auth->get('User.id');
        $authroleID = $this->Auth->get('Auth.User.auth_role_id');

        $query = $query->find('ownedBy', [$user['id']]);

        return $query;
    }
}