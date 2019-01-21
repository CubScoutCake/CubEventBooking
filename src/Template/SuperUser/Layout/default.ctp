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

                    echo $this->Html->link($this->fetch('title')
                        ,['controller' => 'Landing', 'action' => 'super_user_home', 'prefix' => 'super_user']
                        ,['class' => 'navbar-brand']);

                 ?>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
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
                                    <a  class="has-arrow" href="#"><i class="fal fa-calendar-alt fa-fw"></i> Event Types</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EventTypes',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>">View Event Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EventTypes',
                                                'action' => 'add',
                                                'prefix' => 'super_user']); ?>">Add an Event Type</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-signal fa-fw"></i> Event Statuses</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
					                            'controller' => 'EventStatuses',
					                            'action' => 'index',
					                            'prefix' => 'super_user']); ?>">View Event Statuses</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
					                            'controller' => 'EventStatuses',
					                            'action' => 'add',
					                            'prefix' => 'super_user']); ?>">Add an Event Status</a>
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
                                        'prefix' => 'super_user']); ?>">View Discounts</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Discounts',
                                        'action' => 'add',
                                        'prefix' => 'super_user']); ?>">Add a Discount</a>
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
                                'prefix' => 'super_user']); ?>">View Users</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Users',
                                'action' => 'add',
                                'prefix' => 'super_user']); ?>">Add User</a>
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
                                        'prefix' => 'super_user']); ?>">View All</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Notes',
                                        'action' => 'add',
                                        'prefix' => 'super_user']); ?>">New Note</a>
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
                                        'prefix' => 'super_user']); ?>">View All</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Notifications',
                                        'action' => 'unread',
                                        'prefix' => 'super_user']); ?>">View Unread</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-envelope fa-fw"></i> Emails</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EmailSends',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>"><i class="fal fa-paper-plane fa-fw"></i> View Email Sends</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EmailResponses',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>"><i class="fal fa-envelope-open fa-fw"></i> View Email Responses</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-ticket fa-fw"></i> Tokens</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Tokens',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>"> View Tokens </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Tokens',
                                                'action' => 'add',
                                                'prefix' => 'super_user']); ?>"> Add a Token </a>
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
                                'prefix' => 'super_user']); ?>">View Districts</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Districts',
                                'action' => 'add',
                                'prefix' => 'super_user']); ?>">Add a District</a>
                                </li>

                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-life-ring fa-fw"></i> Champions</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Champions',
                                        'action' => 'index',
                                        'prefix' => 'super_user']); ?>">View Champions</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'Champions',
                                        'action' => 'add',
                                        'prefix' => 'super_user']); ?>">Add a Champion</a>
                                        </li>
                                    </ul>
                                </li>                                
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#"><i class="fal fa-paw fa-fw"></i> Scout Groups</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                        'controller' => 'Scoutgroups',
                                        'action' => 'index',
                                        'prefix' => 'super_user']); ?>">View Scout Groups</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                        'controller' => 'Scoutgroups',
                                        'action' => 'add',
                                        'prefix' => 'super_user']); ?>">Add a Scout Group</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#"><i class="fal fa-fire fa-fw"></i> Sections</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                        'controller' => 'Sections',
                                        'action' => 'index',
                                        'prefix' => 'super_user']); ?>">View Sections</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                        'controller' => 'Sections',
                                        'action' => 'add',
                                        'prefix' => 'super_user']); ?>">Add a Section</a>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-free-code-camp fa-fw"></i> Section Types</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'SectionTypes',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>">View Section Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'SectionTypes',
                                                'action' => 'add',
                                                'prefix' => 'super_user']); ?>">Add a Section Type</a>
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
                                'prefix' => 'super_user']); ?>">View Settings</a>
                                </li>
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                'controller' => 'Settings',
                                'action' => 'add',
                                'prefix' => 'super_user']); ?>">Add a Setting</a>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-cogs fa-fw"></i> Setting Types</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'SettingTypes',
                                        'action' => 'index',
                                        'prefix' => 'super_user']); ?>">View Setting Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                        'controller' => 'SettingTypes',
                                        'action' => 'add',
                                        'prefix' => 'super_user']); ?>">Add a Setting Type</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-unlock fa-fw"></i> Password States</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'PasswordStates',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>">View Password States</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'PasswordStates',
                                                'action' => 'add',
                                                'prefix' => 'super_user']); ?>">Add a Password State</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-envelope-square fa-fw"></i> Email Response Types</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EmailResponseTypes',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>"> View Response Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'EmailResponseTypes',
                                                'action' => 'add',
                                                'prefix' => 'super_user']); ?>">Add a Response Type</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-flag-checkered fa-fw"></i> Notification Types</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'NotificationTypes',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>"> View Notification Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'NotificationTypes',
                                                'action' => 'add',
                                                'prefix' => 'super_user']); ?>">Add a Notification Type</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-thermometer fa-fw"></i> Application Statuses</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
					                            'controller' => 'ApplicationStatuses',
					                            'action' => 'index',
					                            'prefix' => 'super_user']); ?>"> View Application Statuses</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
					                            'controller' => 'ApplicationStatuses',
					                            'action' => 'add',
					                            'prefix' => 'super_user']); ?>">Add an Application Status</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow" href="#"><i class="fal fa-cubes fa-fw"></i> Item Types</a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'ItemTypes',
                                                'action' => 'index',
                                                'prefix' => 'super_user']); ?>"> View Item Types</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'ItemTypes',
                                                'action' => 'add',
                                                'prefix' => 'super_user']); ?>">Add an Item Type</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#"><i class="fal fa-tree fa-fw"></i> Logs</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $this->Url->build([
                                        'controller' => 'Logs',
                                        'action' => 'index',
                                        'prefix' => 'super_user']); ?>">View Logs</a>
                                </li>
                                <li>
                                    <?php echo $this->Form->postLink(__('Remove {0}', __('Duplicates')), [
                                            'controller' => 'Logs',
                                            'prefix' => 'super_user',
                                            'action' => 'removeDuplicates'
                                    ]); ?>
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
