<?php

use Cake\Core\Configure;


/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'HertsCubs Booking System';
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php echo $this->element('style'); ?>

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <!-- Actual Fetch -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('style') ?>

</head>
<body>
    <div id="wrapper">
        <?php echo $this->element('analytics'); ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php 

                if (is_null($this->request->getSession()->read('Auth.User.username'))) {

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'welcome', 'prefix' => false]
                        ,['class' => 'navbar-brand']);

                } elseif ($this->request->getSession()->read('Auth.User.authrole') === 'admin') {

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]
                        ,['class' => 'navbar-brand']);

                } elseif ($this->request->getSession()->read('Auth.User.authrole') === 'champion') {

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]
                        ,['class' => 'navbar-brand']);

                } else {

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]
                        ,['class' => 'navbar-brand']);

                } ?>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fal fa-envelope fa-fw"></i>  <i class="falfa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="falfa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>-->
                <!-- /.dropdown -->
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fal fa-clipboard-list fa-fw"></i>  <i class="falfa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <?php   //$usr = $this->request->getSession()->read('Auth.User.id');
                                //$apps = $this->cell('Apps', [$usr]); 
                                //echo $apps; ?>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="falfa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    
                </li>-->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fal fa-bell fa-fw <?php if (isset($unreadNotifications) && $unreadNotifications) : ?> text-danger animated swing infinite <?php endif; ?>"></i>  <i class="fal fa-caret-down <?php if (isset($unreadNotifications) && $unreadNotifications) : ?> text-danger <?php endif; ?>"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?php   $usr = $this->request->getSession()->read('Auth.User.id');
                        $cell = $this->cell('Bell', [$usr], [
                            'cache' => ['config' => 'cell_cache', 'key' => 'bell_' . $usr]
                        ]);
                        echo $cell; ?>
                        <li>
                            <a class="text-center" href="<?php echo $this->Url->build([
                                'controller' => 'Notifications', 
                                'action' => 'index', 
                                'prefix' => false]); ?>">
                                <strong>See All Notifications</strong>
                                <i class="fal fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <?php   $usr = $this->request->getSession()->read('Auth.User.id');
                $cell = $this->cell('Profile', [$usr], [
                    'cache' => ['config' => 'cell_cache', 'key' => 'profile_' . $usr]
                ]);
                echo $cell; ?>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="metismenu">
                        <!-- <?php
                            echo $this->Html->getCrumbList(
                                [
                                    'firstClass' => false,
                                    'lastClass' => 'active',
                                    'class' => 'breadcrumb'
                                ],
                                'Home'
                            );
                        ?> -->
                        <?php   $arid = $this->request->getSession()->read('Auth.User.auth_role_id');
                        $cell = $this->cell('Sidebar', [$arid], [
                            'cache' => ['config' => 'cell_cache', 'key' => 'sidebar_user_' . $arid]
                        ]);
                        echo $cell; ?>

                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">

            <br />

            <?php if (!$this->fetch('tb_flash')) {
                $this->start('tb_flash');

                if (isset($this->Flash)) {
                    echo $this->Flash->render();
                    echo $this->Flash->render('auth');
                }
                $this->end();
            }
            echo $this->fetch('tb_flash'); ?>
            <?= $this->Flash->render() ?>
            <?= $this->Flash->render('auth') ?>
                 
            <?= $this->fetch('content') ?>    

        </div>

        <?php echo $this->element('script'); ?>
        <!-- Actual Script Fetch -->
        <?= $this->fetch('script') ?>
    </div>
</body>

<?php echo $this->element('footer'); ?>

</html>
