<?php
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
<html>
<head>

    <!-- Bootstrap Implementation -->

    <?php //echo $this->Html->css('bootstrap.min.css');?>
    <?php //echo $this->Html->script('jquery.js');?>
    <?php //echo $this->Html->script('bootstrap.min.js');?>
    <?php //echo $this->Html->script('analytics.js');?>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('hertscubs100.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>   



</head>
<body>
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

    <header>
        <div id="logo" class="header-logo">
            <?= $this->Html->image('icons/CampfireHomeSmall.png', ['alt' => 'Admin Home', 'url' => ['controller' => 'Landing', 'action' => 'admin_home', 'prefix' => 'admin']]) ?>
        </div>

        <div class="header-title">
            <span><?= $this->fetch('title') ?></span>
        </div>
        <div class="header-help">
            <?= $this->fetch('Menu');

            $this->start('Menu');
            $this->end();

            if (is_null($this->request->session()->read('Auth.User.username'))) {

                echo "Not Logged In ";

                echo $this->element('Menu/outside');

            } elseif ($this->request->session()->read('Auth.User.authrole') === 'admin') {

                echo $this->element('Menu/user');
                echo $this->element('Menu/admin');

                $AText = "Admin: " . $this->request->session()->read('Auth.User.username');

                echo $this->Html->link($AText, ['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')], ['class' => 'button']);

            } elseif ($this->request->session()->read('Auth.User.authrole') === 'champion') {

                echo $this->element('Menu/user');
                echo $this->element('Menu/champion');

                $CText = "Champion: " . $this->request->session()->read('Auth.User.username');

                echo $this->Html->link($CText, ['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')], ['class' => 'button']);

            } else {

                echo $this->element('Menu/user');

                $UText = "User: " . $this->request->session()->read('Auth.User.username');

                echo $this->Html->link($UText, ['controller' => 'Users', 'action' => 'edit', $this->request->session()->read('Auth.User.id')], ['class' => 'button']);

            } ?>
        </div>
    </header>
    <div id="container">

        <div id="content">
            <?= $this->Flash->render() ?>
            <?= $this->Flash->render('auth') ?>

            <div class="row">              
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
            <div class="footer-title">
                <Span><a target="JacobAGTyler" href="http://bit.ly/1EOXzYQ">Designed &amp Developed by Jacob Tyler</a></span>
            </div>
        </footer>
    </div>
</body>
</html>
