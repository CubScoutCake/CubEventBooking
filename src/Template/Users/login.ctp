<?= $this->assign('title', 'Hertfordshire Cubs'); ?>

<div class="users actions large-2 medium-3 columns">
	
	<?= $this->start('Sidebar');
	echo $this->element('Sidebar/outside');
	$this->end(); ?>
	
	<?= $this->fetch('Sidebar') ?>
	
</div>
<div class="users form large-10 medium-9 columns">
	<h1>Login</h1>
	<?= $this->Form->create() ?>
	<?= $this->Form->input('username') ?>
	<?= $this->Form->input('password') ?>
	<?= $this->Form->button('Login') ?>
	<?= $this->Form->end() ?>

	
</div>