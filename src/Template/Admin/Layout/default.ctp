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

    <!-- Bootstrap Implementation -->

    <?php echo $this->Html->css('bootstrap.min.css');?>
    <?php //echo $this->Html->script('jquery.js');?>
    <?php //echo $this->Html->script('analytics.js');?>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Jan16 Admin Theme Scripts -->

    <?php echo $this->Html->css('metisMenu.min.css'); ?>
    <?php echo $this->Html->css('sb-admin-2.css'); ?>
    <?php echo $this->Html->css('timeline.css'); ?>
    <?php echo $this->Html->css('print.css'); ?>
    <?php echo $this->Html->css('https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css'); ?>


    <!-- Old Style CSS -->

    <?php //echo $this->Html->css('base.css'); ?>
    <?php //echo $this->Html->css('cake.css'); ?>
    <?php //echo $this->Html->css('hertscubs100.css'); ?>

    <!-- Actual Fetch -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>
    <div id="wrapper">
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];
        a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        <?php
        // New Google Analytics code to set User ID.
        // $userId is a unique, persistent, and non-personally identifiable string ID.
        if (!is_null($this->request->session()->read('Auth.User.id'))) {
          $gaucode = "ga('create', 'UA-71500319-2', 'auto', {'userId': 'HERTS-USR:" . $this->request->session()->read('Auth.User.id') . "'});";
          echo sprintf($gaucode);
        } else {
          $gacode = "ga('create', 'UA-71500319-2', 'auto');";
          echo sprintf($gacode);
        }?>

        ga('require', 'linkid');

        ga('send', 'pageview');
        </script>

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
                        ,['controller' => 'Landing', 'action' => 'admin_home', 'prefix' => 'admin']
                        ,['class' => 'navbar-brand']);

                } elseif ($this->request->session()->read('Auth.User.authrole') === 'champion') {

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'champion_home', 'prefix' => 'champion']
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
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?php   $usr = $this->request->session()->read('Auth.User.id');
                                $cell = $this->cell('Notifications', [$usr]); 
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                        </li>
                        <li><a href="<?php

                        if (is_null($this->request->session()->read('Auth.User.username'))) {

                            echo $this->Url->build(['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')]);

                        } elseif ($this->request->session()->read('Auth.User.authrole') === 'admin') {

                            echo $this->Url->build(['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')]);

                        } elseif ($this->request->session()->read('Auth.User.authrole') === 'champion') {

                            echo $this->Url->build(['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')]);

                        } else {

                            echo $this->Url->build(['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')]);

                        } ?>"><i class="fa fa-user fa-fw"></i> <?php

                        if (is_null($this->request->session()->read('Auth.User.username'))) {

                            echo " Not Logged In";

                        } elseif ($this->request->session()->read('Auth.User.authrole') === 'admin') {

                            echo " " . $this->request->session()->read('Auth.User.full_name') . " Profile";

                        } elseif ($this->request->session()->read('Auth.User.authrole') === 'champion') {

                            echo " " . $this->request->session()->read('Auth.User.full_name') . " Profile";

                        } else {

                            echo " " . $this->request->session()->read('Auth.User.full_name') . " Profile";

                        } ?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $this->Url->build([
                            'controller' => 'Users',
                            'action' => 'logout',
                            'prefix' => false]); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <?= $this->Form->create($adminFormLink, ['url' => ['controller' => 'Landing', 'action' => 'link'], 'class' => 'custom-search-form input-group']); ?>
                            <fieldset>
                                <?php echo $this->Form->input('link', [
                                    'label' => false, 
                                    'class' => 'input-group-form form-control', 
                                    'placeholder' => 'Search...'
                                ]); ?>
                            </fieldset>
                            <span class="input-group-btn">
                                <?= $this->Form->button(__('<i class="fa fa-search"></i>'),['class' => 'btn btn-default', 'escape' => false ]) ?>
                            </span>
                            <?= $this->Form->end() ?>                            
                            <!-- /input-group -->
                        </li>
                        <?php if ($this->request->session()->read('Auth.User.authrole') === 'admin'): ?>
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Landing',
                                'action' => 'admin_home',
                                'prefix' => 'admin']); ?>"><i class="fa fa-rocket fa-fw"></i> Admin Home</a>
                        </li>
                        <?php endif ?>
                        <?php $r = $this->request->session()->read('Auth.User.authrole');
                        if ( $r === 'admin' || $r === 'champion'): ?>
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Landing',
                                'action' => 'champion_home',
                                'prefix' => 'champion']); ?>"><i class="fa fa-life-ring fa-fw"></i> Champion Home</a>
                        </li>
                        <?php endif ?>
                        <li>
                            <a href="<?php echo $this->Url->build([
                                'controller' => 'Landing',
                                'action' => 'user_home',
                                'prefix' => false]); ?>"><i class="fa fa-dashboard fa-fw"></i> User Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar-o fa-fw"></i> Events <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Events',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Events</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Events',
                                'action' => 'add',
                                'prefix' => 'admin']); ?>">Add a New Event</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-chevron-circle-down fa-fw"></i> Discounts <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Discounts',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View Discounts</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Discounts',
                                        'action' => 'add',
                                        'prefix' => 'admin']); ?>">Add a Discount</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Users <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Users',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Users</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Users',
                                'action' => 'add',
                                'prefix' => 'admin']); ?>">Add User</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Applications<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Applications',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Applications</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Applications',
                                'action' => 'add',  
                                'prefix' => 'admin']); ?>">Add New Application</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-group fa-fw"></i> Attendees<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Attendees',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Attendees</a>
                                </li>
                                <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Attendees',
                                'action' => 'unattached',
                                'prefix' => 'admin']); ?>">Unattached Attendees</a>
                                </li>
                                <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Attendees',
                                'action' => 'add',
                                'prefix' => 'admin']); ?>">Add New Attendee</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-exclamation fa-fw"></i> Allergies <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Allergies',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View Allergies</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Allergies',
                                        'action' => 'add',
                                        'prefix' => 'admin']); ?>">Add an Allergy</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-child fa-fw"></i> Roles <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Roles',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View Roles</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Roles',
                                        'action' => 'add',
                                        'prefix' => 'admin']); ?>">Add a Role</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Invoices<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Invoices',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Invoices</a>
                                </li>
                                <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Invoices',
                                'action' => 'unpaid',
                                'prefix' => 'admin']); ?>">Unpaid Invoices</a>
                                </li>
                                <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Invoices',
                                'action' => 'outstanding',
                                'prefix' => 'admin']); ?>">Outstanding Invoices</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Invoices',
                                'action' => 'generate',
                                'prefix' => 'admin']); ?>">Generate New Invoice</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gbp fa-fw"></i> Payments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Payments',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Payments</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Payments',
                                'action' => 'add',
                                'prefix' => 'admin']); ?>">Add a New Payment</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-comments-o fa-fw"></i> Communications<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Notes <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Notes',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View All</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Notes',
                                        'action' => 'add',
                                        'prefix' => 'admin']); ?>">New Note</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-bell fa-fw"></i> Notifications <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Notifications',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View All</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Notifications',
                                        'action' => 'unread',
                                        'prefix' => 'admin']); ?>">View Unread</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Districts <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Districts',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Districts</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Districts',
                                'action' => 'add',
                                'prefix' => 'admin']); ?>">Add a District</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-paw fa-fw"></i> Scout Groups <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Scoutgroups',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View Scout Groups</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Scoutgroups',
                                        'action' => 'add',
                                        'prefix' => 'admin']); ?>">Add a Scout Group</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-life-ring fa-fw"></i> Champions <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Champions',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View Champions</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Champions',
                                        'action' => 'add',
                                        'prefix' => 'admin']); ?>">Add a Champion</a>
                                        </li>
                                    </ul>
                                </li>                                
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gear fa-fw"></i> Settings <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Settings',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Settings</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Settings',
                                'action' => 'add',
                                'prefix' => 'admin']); ?>">Add a Setting</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-gears fa-fw"></i> Setting Types <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Settingtypes',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View Setting Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Settingtypes',
                                        'action' => 'add',
                                        'prefix' => 'admin']); ?>">Add a Setting Type</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
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
                }
                $this->end();
            }
            echo $this->fetch('tb_flash'); ?>
            <?= $this->Flash->render() ?>
            <?= $this->Flash->render('auth') ?>
                 
            <?= $this->fetch('content') ?>    

        </div>
        <footer>
            <div class="navbar navbar-static-bottom">
                <ul class="nav navbar-top-links navbar-right">
                    <li><a target="JacobAGTyler" href="http://bit.ly/1EOXzYQ">Designed &amp Developed by Jacob Tyler</a></li>
                </ul>
            </div>
        </footer>
    </div>
</body>

<!-- jQuery -->
<?php echo $this->Html->script('jquery.min.js');?>
<?php echo $this->Html->script('jquery.min.js'); ?>

<!-- enquiry -->
<?php echo $this->Html->script('enquiry.js');?>

<!-- Bootstrap Core JavaScript -->
<?php echo $this->Html->script('bootstrap.min.js');?>
<?php echo $this->Html->script('DataTables.bootstrap.min.js'); ?>

<!-- Metis Menu Plugin JavaScript -->
<?php echo $this->Html->script('metisMenu.min.js');?>

<!-- DataTable Script -->
<?php echo $this->Html->script('DataTables.cakephp.dataTables.js'); ?>

<!-- Morris Charts JavaScript -->
<?php //echo $this->Html->script('raphael-min.js');?>
<?php //echo $this->Html->script('morris.min.js');?>
<?php //echo $this->Html->script('morris-data.js');?>

<?php echo $this->Html->script('https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js'); ?>

<!-- Font Awesome CDN -->
<?php echo $this->Html->script('https://use.fontawesome.com/687b7f2021.js');?>

<!-- Custom Theme JavaScript -->
<?php echo $this->Html->script('sb-admin-2.js');?>

<!-- Actual Script Fetch -->
<?= $this->fetch('script') ?>

</html>
