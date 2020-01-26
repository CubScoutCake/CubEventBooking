<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Sidebar cell
 *
 * @property \App\Model\Table\AuthRolesTable $AuthRoles
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
     * @param int $authRoleId The Auth Role ID being displayed.
     *
     * @return void
     */
    public function display($authRoleId)
    {
        $this->loadModel('AuthRoles');
        $authRole = $this->AuthRoles->get($authRoleId);

        $this->set('auth_role', $authRole);
        $this->set('prefix', $this->request->getParam('prefix'));
    }
}
