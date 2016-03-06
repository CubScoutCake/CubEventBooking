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

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <!-- For old IEs -->    
    <link rel="shortcut icon" href="/favicon/favicon.ico" />

    <!-- For new browsers - multisize ico  -->
    <?= $this->Html->meta(   
        'favicon.ico',
        '/favicon/favicon.ico',
        ['type' => 'icon', 'sizes' => '16x16 32x32']
    ); ?>
    <?= $this->Html->meta(   
        'favicon.ico',
        '/favicon/favicon.ico',
        ['type' => 'icon']
    ); ?>
    <link rel="icon" type="image/x-icon" sizes="16x16 32x32" href="/favicon/favicon.ico">

    <!-- For iPad with high-resolution Retina display running iOS ≥ 7: -->
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/favicon/favicon-152.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/favicon-152.png">

    <!-- For iPad with high-resolution Retina display running iOS ≤ 6: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/favicon/favicon-144.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/favicon-144.png">

    <!-- For iPhone with high-resolution Retina display running iOS ≥ 7: -->
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/favicon/favicon-120.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/favicon-120.png">

    <!-- For iPhone with high-resolution Retina display running iOS ≤ 6: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/favicon/favicon-114.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/favicon-114.png">

    <!-- For iPhone 6+ -->
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="/favicon/favicon-180.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/favicon-180.png">

    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/favicon/favicon-72.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/favicon-72.png">

    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="/favicon/favicon-57.png">
    <link rel="apple-touch-icon" href="/favicon/favicon-57.png">

    <!-- For Old Chrome -->
    <link rel="icon" href="/favicon/favicon-32.png" sizes="32x32">

    <!-- For IE10 Metro -->
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="/favicon/favicon-144.png">

    <!-- Chrome for Android -->
    <link rel="icon" sizes="192x192" href="/favicon/favicon-192.png">
    <link rel="mask-icon" href="favicon/mask.svg" color="#009A44">

    <?= $this->Html->css('hertscubs100.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('hertscubs100.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?> 

    <!-- Bootstrap Implementation 
    <?php //echo $this->Html->css('bootstrap/bootstrap.css'); ?>
    <?php //echo $this->Html->script(['jquery/dist/jquery.js', 'bootstrap/bootstrap.js']);;?>-->

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
      $gaucode = "ga('create', 'UA-67251861-2', 'auto', {'userId': 'HERTS-USR:" . $this->request->session()->read('Auth.User.id') . "'});";
      echo sprintf($gaucode);
    } else {
      $gacode = "ga('create', 'UA-67251861-2', 'auto');";
      echo sprintf($gacode);
    }?>

    ga('require', 'linkid');

    ga('send', 'pageview');
    </script>

    <header>
        <div class="header-title">
            <span><?= $this->fetch('title') ?></span>
        </div>
        <div class="header-help">
            <?= $this->fetch('Menu');

            if ($mobile === 0)
            {
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

                }
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
