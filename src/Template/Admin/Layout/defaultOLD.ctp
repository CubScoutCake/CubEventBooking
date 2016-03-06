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

    <!-- Bootstrap Implementation 

    <?php //echo $this->Html->css('bootstrap.min.css');?>
    <?php //echo $this->Html->script('jquery.js');?>
    <?php //echo $this->Html->script('bootstrap.min.js');?>
    -->

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

    <header>
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
