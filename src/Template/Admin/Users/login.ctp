<div class="users_form">
	<h1>Login</h1>
	<?= $this->Form->create() ?>
	<?= $this->Form->input('username') ?>
	<?= $this->Form->input('password') ?>
	<?= $this->Form->button('Login') ?>
	<?= $this->Form->end() ?>

	<?= echo $this->Html->link(
		'Register',
		'/Users/Register',
		['class' => 'button', 'target' => '_blank']
	); ?>
</div>