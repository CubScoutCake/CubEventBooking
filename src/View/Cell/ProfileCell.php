<?php
namespace App\View\Cell;

use App\Model\Table\ParametersTable;
use Cake\View\Cell;

/**
 * Profile cell
 */
class ProfileCell extends Cell
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
        $kill = 0;

        if (is_null($userId)) {
            $kill = 1;
        }
        $this->set($kill, 'kill');

        if (!is_null($userId)) {
            $this->loadModel('Users');
            $this->loadModel('AuthRoles');

            $prefix = false;

            $user = $this->Users->get($userId);
            $name = $user->full_name;
            $this->set(compact('name', 'userId'));
            $authRole = $this->AuthRoles->get($user['auth_role_id']);

            if ($authRole['champion_access']) {
                $champion = 1;
                $prefix = 'champion';
            } else {
                $champion = 0;
            }
            $this->set('champion', $champion);

            if ($authRole['admin_access']) {
                $admin = 1;
                $prefix = 'admin';
            } else {
                $admin = 0;
            }
            $this->set('admin', $admin);

            /*if ($authRole['super_user']) {
                $superUser = 1;
                $prefix = 'super-user';
            } else {
                $superUser = 0;
            }
            $this->set('super', $superUser);*/

            $this->set('prefix', $prefix);
        }
    }
}
