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

                if (is_null($this->request->session()->read('Auth.User.username'))) {

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'welcome', 'prefix' => false]
                        ,['class' => 'navbar-brand']);

                } elseif ($this->request->session()->read('Auth.User.authrole') === 'admin') {

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]
                        ,['class' => 'navbar-brand']);

                } elseif ($this->request->session()->read('Auth.User.authrole') === 'champion') {

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
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
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
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>-->
                <!-- /.dropdown -->
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <?php   //$usr = $this->request->session()->read('Auth.User.id');
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
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    
                </li>-->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw <?php if ($unreadNotifications == true) : ?> text-danger animated swing infinite <?php endif; ?>"></i>  <i class="fa fa-caret-down <?php if ($unreadNotifications == true) : ?> text-danger <?php endif; ?>"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?php   $usr = $this->request->session()->read('Auth.User.id');
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
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <?php   $usr = $this->request->session()->read('Auth.User.id');
                $cell = $this->cell('Profile', [$usr], [
                    'cache' => ['config' => 'cell_cache', 'key' => 'profile_' . $usr]
                ]);
                echo $cell; ?>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
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
                        <?php   $usr = $this->request->session()->read('Auth.User.id');
                        $cell = $this->cell('Roleside', [$usr], [
                            'cache' => ['config' => 'cell_cache', 'key' => 'roleside_' . $usr]
                        ]);
                        echo $cell; ?>
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Events',
                                'action' => 'index',
                                'prefix' => false]); ?>">
                                <i class="fa fa-calendar-o fa-fw"></i> Events</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Applications',
                                'action' => 'index',
                                'prefix' => false]); ?>">
                                <i class="fa fa-tasks fa-fw"></i> Applications</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <!--<li>
                            <a href="#"><i class="fa fa-group fa-fw"></i> Attendees<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php /*echo $this->Url->build([
                                'controller' => 'Attendees',
                                'action' => 'index',
                                'prefix' => false]); */?>">View Attendees</a>
                                </li>
                                <li>
                                    <a href="<?php /*echo $this->Url->build([
                                'controller' => 'Attendees',
                                'action' => 'cub',
                                'prefix' => false]); */?>">Add New Young Person</a>
                                </li>
                                <li>
                                    <a href="<?php /*echo $this->Url->build([
                                'controller' => 'Attendees',
                                'action' => 'adult',
                                'prefix' => false]); */?>">Add New Adult</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-exclamation fa-fw"></i> Allergies <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php /*echo $this->Url->build([
                                        'controller' => 'Allergies',
                                        'action' => 'index',
                                        'prefix' => false]); */?>">View Allergies</a>
                                        </li>
                                        <li>
                                            <a href="<?php /*echo $this->Url->build([
                                        'controller' => 'Allergies',
                                        'action' => 'add',
                                        'prefix' => false]); */?>">Add an Allergy</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-child fa-fw"></i> Roles <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php /*echo $this->Url->build([
                                        'controller' => 'Roles',
                                        'action' => 'index',
                                        'prefix' => false]); */?>">View Roles</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>-->
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Osm',
                                'action' => 'home',
                                'prefix' => false]); ?>">
                                <i class="fa fa-refresh fa-fw"></i> OSM Sync</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Invoices',
                                'action' => 'index',
                                'prefix' => false]); ?>">
                                <i class="fa fa-files-o fa-fw"></i> Invoices</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Payments',
                                'action' => 'index',
                                'prefix' => false]); ?>">
                                <i class="fa fa-gbp fa-fw"></i> Payments</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> More<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Scoutgroups',
                                'action' => 'index',
                                'prefix' => false]); ?>">View Scout Groups</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Champions',
                                'action' => 'index',
                                'prefix' => false]); ?>">View Champions</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Districts',
                                'action' => 'index',
                                'prefix' => false]); ?>">View Districts</a>
                                </li>
                                <!--<li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul> -->
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">

            </br>

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
