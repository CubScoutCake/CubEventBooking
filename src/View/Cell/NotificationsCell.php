<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Notifications cell
 */
class NotificationsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($userId = null)
    {
        $this->loadModel('Notifications');
<<<<<<< HEAD
        $this->loadModel('Notificationstypes');
        $unread = $this->Notifications->find('all')->where(['user_id' => $userId, 'new' => 1])->contain(['Notificationtypes']);
        $this->set('notifications', $unread);

        //$this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
=======
        $unread = $this->Notifications->find('all')->where(['user_id' => $userId, 'new' => 1]);
        $this->set('unread_count', $unread->count());
>>>>>>> master
    }
}
