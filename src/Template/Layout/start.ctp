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

    <?php echo $this->Html->css('metisMenu.min.css');?>
    <?php echo $this->Html->css('sb-admin-2.css');?>
    <?php echo $this->Html->css('timeline.css');?>
    <?php echo $this->Html->css('font-awesome.css');?>

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

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Landing',
                        'action' => 'welcome',
                        'prefix' => false]); ?>"><i class="fa fa-flag-checkered fa-fw"></i> Start Page</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'login',
                        'prefix' => false]); ?>"><i class="fa fa-sign-in fa-fw"></i> Login</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'register',
                        'prefix' => 'register']); ?>"><i class="fa fa-pencil-square-o fa-fw"></i> Register</a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build([
                        'controller' => 'Mailchimp',
                        'action' => 'mailchimp',
                        'prefix' => false]); ?>"><i class="fa fa-envelope-o fa-fw"></i> Sign Up for Emails</a>
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

    <!-- jQuery -->
    <?php echo $this->Html->script('jquery.min.js');?>

    <!-- Bootstrap Core JavaScript -->
    <?php echo $this->Html->script('bootstrap.min.js');?>

    <!-- Metis Menu Plugin JavaScript -->
    <?php echo $this->Html->script('metisMenu.min.js');?>

    <!-- Custom Theme JavaScript -->
    <?php echo $this->Html->script('sb-admin-2.js');?>

    <!-- Actual Script Fetch -->
    <?= $this->fetch('script') ?>

</body>
<footer>
    <div class="footer-title">
        <Span><a target="JacobAGTyler" href="http://bit.ly/1EOXzYQ">Designed &amp Developed by Jacob Tyler</a></span>
    </div>
</footer> 
</html>
