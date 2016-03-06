<!DOCTYPE html>
<html>
<head>
<?php
define("APPLICATIONTIMEFORMAT", "dd-MMM-yy");
 
// this standard CakePHP does NOT work
echo $this->Html->meta('icon');
echo $this->Html->css('pdf');
echo $this->fetch('meta');
echo $this->fetch('css');
?>

<title>stylus PDF</title>

<!-- // but this does... 

<link rel="stylesheet" type="text/css" href="<?php echo APP.'webroot'.DS.'css'.DS.'pdf.css'; ?>" media="all" />-->
</head>
<body id="pdf">