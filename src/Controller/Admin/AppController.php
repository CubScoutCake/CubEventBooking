<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 *
 * @property \App\Controller\Component\AlertComponent $Alert
 */
class AppController extends Controller
{
    /**
     * @throws \Exception
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'loginRedirect' => [
                'prefix' => false,
                'controller' => 'Landing',
                'action' => 'user_home',
                ],
            'loginAction' => [
                'prefix' => false,
                'controller' => 'Users',
                'action' => 'login',
                ],
        ]);

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);

        $this->loadComponent('Alert');
        $this->Alert->appLoad($this->Auth->user('id'));
    }

    /**
     * Authorisation Validation Method
     *
     * @param array $user The Auth->User to be Validated
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        $auth = TableRegistry::get('AuthRoles');

        $adminTrue = $auth->get($user['auth_role_id']);

        if (!isset($user['auth_role_id'])) {
            return false;
        }

        if ($this->request->getParam('prefix') === 'admin' && isset($user['auth_role_id'])) {
            return (bool)($adminTrue['admin_access']);
        }

        return false;
    }
}
