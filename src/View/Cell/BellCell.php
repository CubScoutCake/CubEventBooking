<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Bell cell
 */
class BellCell extends Cell
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
     * @param int $userId The User Id for display.
     *
     * @return void
     */
    public function display($userId = null)
    {
        $this->loadModel('Notifications');
        $unread = $this->Notifications->find('all')->where(['user_id' => $userId, 'new' => 1])->contain(['NotificationTypes']);
        $this->set('notifications', $unread);

        //$this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }
}
