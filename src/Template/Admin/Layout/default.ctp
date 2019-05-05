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

$cakeDescription = 'HCBS';
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
                        <i class="fal fa-envelope fa-fw"></i>  <i class="fal fa-caret-down"></i>
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
                                <i class="fal fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>-->
                <!-- /.dropdown -->
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fal fa-clipboard-list fa-fw"></i>  <i class="fal fa-caret-down"></i>
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
                                <i class="fal fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    
                </li>-->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fal fa-bell fa-fw"></i>  <i class="fal fa-caret-down"></i>
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
                                <i class="fal fa-angle-right"></i>
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
                    <ul class="nav" id="metismenu">
                        <?php   echo $this->cell('QuickLink'); ?>
                        <?php   $usr = $this->request->session()->read('Auth.User.id');
                        $cell = $this->cell('Roleside', [$usr], [
                            'cache' => ['config' => 'cell_cache', 'key' => 'roleside_' . $usr]
                        ]);
                        echo $cell; ?>
                        <li>
                            <a class="has-arrow" href="#"><i class="fal fa-calendar-star fa-fw"></i> Events</a>
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
                                    <a class="has-arrow" href="#"><i class="fal fa-inventory fa-fw"></i> Logistics</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Logistics',
                                                'action' => 'index',
                                                'prefix' => 'admin']); ?>">View Logistics</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Parameters',
                                                'action' => 'index',
                                                'prefix' => 'admin']); ?>">View Parameters</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Parameters',
                                                'action' => 'add',
                                                'prefix' => 'admin']); ?>">Add a Parameter</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-tag fa-fw"></i> Discounts</a>
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
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-calendar-alt fa-fw"></i> Event Types</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EventTypes',
                                                'action' => 'index',
                                                'prefix' => 'admin']); ?>">View Event Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EventTypes',
                                                'action' => 'add',
                                                'prefix' => 'admin']); ?>">Add an Event Type</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#"><i class="fal fa-user-circle fa-fw"></i> Users</a>
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
                            <a class="has-arrow" href="#"><i class="fal fa-clipboard-list fa-fw"></i> Applications</a>
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
                            <a class="has-arrow" href="#"><i class="fal fa-ticket-alt fa-fw"></i> Reservations</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                        'controller' => 'Reservations',
                                        'action' => 'index',
                                        'prefix' => 'admin']); ?>">View Reservations</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                        'controller' => 'Reservations',
                                        'action' => 'process',
                                        'prefix' => 'admin']); ?>">Process Reservation</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a class="has-arrow" href="#"><i class="fal fa-poll-people fa-fw"></i> Attendees</a>
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
                                    <a class="has-arrow" href="#"><i class="fal fa-allergies fa-fw"></i> Allergies</a>
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
                                    <a class="has-arrow" href="#"><i class="fal fa-child fa-fw"></i> Roles</a>
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
                            <a class="has-arrow" href="#"><i class="fal fa-file-invoice-dollar fa-fw"></i> Invoices</a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Invoices',
                                'action' => 'index',
                                'prefix' => 'admin']); ?>">View Invoices</a>
                                </li>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Invoices',
                                        'action' => 'index',
                                        'prefix' => 'admin',
                                        '?' => ['unpaid' => true],
                                    ]); ?>">Unpaid Invoices</a>
                                </li>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Invoices',
                                        'action' => 'index',
                                        'prefix' => 'admin',
                                        '?' => ['outstanding' => true],
                                    ]); ?>">Outstanding Invoices</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a class="has-arrow" href="#"><i class="fal fa-receipt fa-fw"></i> Payments</a>
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
                            <a class="has-arrow" href="#"><i class="fal fa-comments fa-fw"></i> Communications</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-edit fa-fw"></i> Notes</a>
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
                                    <a class="has-arrow" href="#"><i class="fal fa-bell fa-fw"></i> Notifications</a>
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
                            <a class="has-arrow" href="#"><i class="fal fa-sitemap fa-fw"></i> Districts</a>
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
                                    <a class="has-arrow" href="#"><i class="fal fa-fire fa-fw"></i> Sections</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Sections',
                                                'action' => 'index',
                                                'prefix' => 'admin']); ?>">View Sections</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Sections',
                                                'action' => 'add',
                                                'prefix' => 'admin']); ?>">Add a Section</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-paw fa-fw"></i> Scout Groups</a>
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
                                    <a class="has-arrow" href="#"><i class="fal fa-life-ring fa-fw"></i> Champions</a>
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
                            <a class="has-arrow" href="#"><i class="fal fa-cog fa-fw"></i> Settings</a>
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
                            </ul>
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
                }
                $this->end();
            }
            echo $this->fetch('tb_flash'); ?>
            <?= $this->Flash->render() ?>
            <?= $this->Flash->render('auth') ?>
                 
            <?= $this->fetch('content') ?>    

        </div>
    </div>

    <?php echo $this->element('script'); ?>

    <!-- Actual Script Fetch -->
    <?= $this->fetch('script') ?>

</body>

<?php echo $this->element('footer'); ?>

</html>
