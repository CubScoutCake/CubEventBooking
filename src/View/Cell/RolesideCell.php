<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * RoleSide cell
 */
class RoleSideCell extends Cell
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
        $kill = false;

        if (is_null($userId)) {
            $kill = true;
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
                $champion = true;
                $prefix = 'champion';
            } else {
                $champion = false;
            }
            $this->set('champion', $champion);

            if ($authRole['admin_access']) {
                $admin = true;
                $prefix = 'admin';
            } else {
                $admin = false;
            }
            $this->set('admin', $admin);

            if ($authRole['super_user']) {
                $superUser = true;
                //$prefix = 'super-user';
            } else {
                $superUser = false;
            }
            $this->set('super', $superUser);

            $this->set('prefix', $prefix);
        }
    }
}
