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

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="metismenu">
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Landing',
                        'action' => 'welcome',
                        'prefix' => false]); ?>"><i class="fal fa-flag-checkered fa-fw"></i> Start Page</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'login',
                        'prefix' => false]); ?>"><i class="fal fa-sign-in fa-fw"></i> Login</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'register',
                        'prefix' => 'register']); ?>"><i class="fal fa-edit fa-fw"></i> Register</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Mailchimp',
                        'action' => 'mailchimp',
                        'prefix' => false]); ?>"><i class="fal fa-envelope-o fa-fw"></i> Sign Up for Emails</a>
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

    <?php echo $this->element('script'); ?>

    <!-- Actual Script Fetch -->
    <?= $this->fetch('script') ?>

</body>

<?php echo $this->element('footer'); ?>

</html>
