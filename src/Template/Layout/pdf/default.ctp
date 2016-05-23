<?php

use Cake\Core\Configure;

$cakeDescription = 'HertsCubs Booking System';
?>
<html lang="en">
<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <?php //echo $this->Html->css('metisMenu.min.css', ['fullBase' => true]);?>
    <?php //echo $this->Html->css('sb-admin-2.css', ['fullBase' => true]);?>

</head>
<body>
    <div id="wrapper">
             
        <?= $this->fetch('content') ?>    

    </div>
</body>

</html>
