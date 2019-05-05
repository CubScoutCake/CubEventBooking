<?php
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
namespace App\Controller\Parent;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialise Function - Setup Application Config
     * @return void
     *
     * @throws \Exception
     */
    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'loginRedirect' => [
                'controller' => 'Landing',
                'action' => 'user_home',
                'prefix' => false
                ],
            'logoutRedirect' => [
                'controller' => 'Landing',
                'action' => 'welcome',
                'prefix' => false
                ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => false,
                ]
        ]);

        $this->viewBuilder()->setLayout('public');
    }

    /**
     * Determine Authorisation for User in /Register
     *
     * @param \App\Model\Entity\User $user The User to be Evaluated
     * @return bool
     */
    public function isAuthorized($user)
    {
        return false;
    }
}
