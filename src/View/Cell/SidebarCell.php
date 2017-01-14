<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Notifications cell
 */
class SidebarCell extends Cell
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
     * @param int $userId The User ID being displayed.
     *
     * @return void
     */
    public function display($userId = null)
    {
        $this->loadModel('Notifications');
        $unread = $this->Notifications->find('unread')->where(['user_id' => $userId]);
        $this->set('unread_count', $unread->count());
    }
}
