<?php
/**
* @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<?php echo $this->element('style'); ?>

    <title>
        <?= $this->fetch('title') ?>
    </title>

    <!-- Actual Fetch -->

	<?= $this->fetch('meta') ?>

    <!-- Bootstrap core CSS -->
	<?php echo $this->Html->css('bootstrap.min.css'); ?>

	<?php echo $this->Html->css('grayscale.min.css'); ?>
    <?php echo $this->Html->css('herts.css'); ?>
	<?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Varela+Round'); ?>
	<?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i'); ?>
</head>
<body id="page-top">
<?php echo $this->element('analytics'); ?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Hertfordshire Cubs</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?= $this->fetch('parent-nav') ?>
            </ul>
        </div>
    </div>
</nav>

<?php if (!$this->fetch('tb_flash')) {
	$this->start('tb_flash');

	if (isset($this->Flash)) {
		echo $this->Flash->render();
		echo $this->Flash->render('auth');
	}
	$this->end();
}
echo $this->fetch('tb_flash'); ?>
<?= $this->Flash->render() ?>
<?= $this->Flash->render('auth') ?>

<?= $this->fetch('content') ?>

<!-- Bootstrap core JavaScript -->
<?php echo $this->Html->script('bootstrap.bundle.min.js');?>
<?php echo $this->Html->script('https://code.jquery.com/jquery-3.3.1.slim.min.js', ['integrity' => 'sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo', 'crossorigin' => 'anonymous']);?>
<?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', ['integrity' => 'sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1', 'crossorigin' => 'anonymous']);?>
<?php echo $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', ['integrity' => 'sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM', 'crossorigin' => 'anonymous']);?>


<!-- Plugin JavaScript -->
<?php echo $this->Html->script('jquery.easing.min.js');?>

<!-- Custom scripts for this template -->
<?php echo $this->Html->script('grayscale.min.js');?>

<!-- Select 2 -->
<?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js'); ?>
<?php echo $this->Html->script('multi-select.js'); ?>

<!-- Font Awesome -->
<?php echo $this->Html->script('https://pro.fontawesome.com/releases/v5.5.0/js/all.js', ['integrity' => 'sha384-3yBLeJ4waqGSAf4A8pjZ13UF7GuhgbdKnBQvIp/TkWoXtQbtwjlIPNjkDRJ46UCn', 'crossorigin' => 'anonymous']); ?>

<!-- Footer -->
<footer class="bg-purple text-center text-white-50">
    <div class="container">
        Copyright &copy; Hertfordshire County Cubs 2018
    </div>
</footer>

</body>

</html>