<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\View\CellTrait;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    use CellTrait;

    /**
     * The App Initialisation Method.
     *
     * @throws \Exception
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'loginRedirect' => [
                'controller' => 'Landing',
                'action' => 'user_home'
            ],
            'logoutRedirect' => [
                'controller' => 'Landing',
                'action' => 'welcome'
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);

        $this->loadComponent('Security');

        $this->loadComponent('Alert');
        $this->Alert->appLoad($this->Auth->user('id'));
    }

    /**
     * @param array $user The AuthUser
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        if (!isset($user['auth_role_id'])) {
            return false;
        }

        //The add and index actions are always allowed.
        if (isset($user['id']) && in_array($this->request->getParam('action'), ['userHome'])) {
            return true;
        }

        $auth = TableRegistry::getTableLocator()->get('AuthRoles');

        /** @var \App\Model\Entity\AuthRole $authRole */
        $authRole = $auth->get($user['auth_role_id']);

        if (!$authRole->user_access) {
            return false;
        }

        if (isset($user['id'])) {
            if (!empty($this->request->getParam('prefix')) && $this->request->getParam('prefix') === 'admin') {
                return false;
            } else {
                return true;
            }
        }

        //The add and index actions are always allowed.
        if (isset($user['id']) && in_array($this->request->getParam('action'), ['index', 'add'])) {
            return true;
        }

        return false;
    }
}
