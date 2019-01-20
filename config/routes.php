<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::extensions(['pdf']);
Router::extensions(['csv']);

Router::scope('/', function ($routes) {

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */

    //$routes->connect('/', ['controller' => 'Maintainance', 'action' => 'display', 'home']);


    $routes->connect('/', ['controller' => 'Landing', 'action' => 'welcome', '_ssl' => true]);

    $routes->connect('/', ['controller' => 'Landing', 'action' => 'welcome']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    //$routes->connect('/Landing/*', ['controller' => 'Maintainance', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `InflectedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

Router::prefix('admin', function ($routes) {
    // Because you are in the admin scope,
    // you do not need to include the /admin prefix
    // or the admin route element.
    $routes->connect('/', ['controller' => 'Landing', 'action' => 'adminHome', 'admin_home']);

    $routes->fallbacks('DashedRoute');
});

Router::prefix('super_user', function ($routes) {
    // Because you are in the admin scope,
    // you do not need to include the /admin prefix
    // or the admin route element.
    $routes->connect('/', ['controller' => 'Landing', 'action' => 'superUserHome', 'super_user_home']);

    $routes->fallbacks('DashedRoute');
});

Router::prefix('champion', function ($routes) {
    // Because you are in the admin scope,
    // you do not need to include the /admin prefix
    // or the admin route element.
    $routes->connect('/', ['controller' => 'Landing', 'action' => 'championHome', 'champion_home']);

    $routes->fallbacks('DashedRoute');
});

Router::prefix('parent', function ($routes) {
	// Because you are in the admin scope,
	// you do not need to include the /admin prefix
	// or the admin route element.
	$routes->connect('/', ['controller' => 'Reservation', 'action' => 'index', 'index']);

	$routes->fallbacks('DashedRoute');
});

Router::prefix('register', function ($routes) {
    // Because you are in the admin scope,
    // you do not need to include the /admin prefix
    // or the admin route element.
    $routes->connect('/', ['controller' => 'Users', 'action' => 'register']);

    $routes->fallbacks('DashedRoute');
});

Router::prefix('api', function ($routes) {
    // Because you are in the admin scope,
    // you do not need to include the /admin prefix
    // or the admin route element.
    $routes->connect('/', ['controller' => 'Users', 'action' => 'register']);

    $routes->fallbacks('DashedRoute');
});

Router::connect('/login', ['controller' => 'Users', 'action' => 'login']);

Router::connect('/register', ['controller' => 'Users', 'action' => 'register', 'prefix' => 'register']);

Router::connect('/logout', ['controller' => 'Users', 'action' => 'logout']);

//Router::scope('/info', function ($routes) {
//    $routes->connect('/info', ['controller' => 'Users', 'action' => 'view']);
//});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */

/**
* <--- Jacob's Route's --->
*/


Router::defaultRouteClass('DashedRoute');

// Router::mapResources(array('Invoices'));
