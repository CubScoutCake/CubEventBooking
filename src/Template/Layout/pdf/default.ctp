<?php

use Cake\Core\Configure;

$cakeDescription = 'HertsCubs Booking System';
?>
<html lang="en">
<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->element('style'); ?>

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <?= $this->fetch('content') ?>    
        </div>
    </div>
    <?php echo $this->element('script'); ?>
</body>

</html>
