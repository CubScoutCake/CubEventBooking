<?= $this->assign('title', 'Hertfordshire Cubs'); ?>
<<<<<<< HEAD
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
					<?= $this->Form->create() ?>
					<?= $this->Form->input('username') ?>
					<?= $this->Form->input('password') ?>
					<?= $this->Form->button('Login',['class' => 'btn btn-primary']) ?>
					<?= $this->Form->end() ?>
				</div>
				<div class="panel-footer">
				    <a href="<?php echo $this->Url->build([
                    	'controller' => 'Users',
                    	'action' => 'reset',
                    	'prefix' => false],['_full']); ?>">
                    	<button type="button" class="btn btn-default"> Forgot Password</button></a>
				</div>
			</div>
		</div>
	</div>
=======

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

	
>>>>>>> master
</div>