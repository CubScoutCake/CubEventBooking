<?= $this->assign('title', 'Hertfordshire Cubs'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Enter details to request a password reset.</h3>
                </div>
                <div class="panel-body">
					<?= $this->Form->create($PasswordForm); ?>
					<?= $this->Form->input('newpw', ['label' => 'Enter a New Password.', 'type' => 'password']); ?>
					<?= $this->Form->input('confirm', ['label' => 'Confirm Password.', 'type' => 'password']); ?>
					<?= $this->Form->input('postcode', ['label' => 'Enter Postcode.']); ?>
					<?= $this->Form->button('Change Password') ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>