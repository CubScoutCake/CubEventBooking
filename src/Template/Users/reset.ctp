<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Enter details to request a password reset.</h3>
                </div>
                <div class="panel-body">
					<?= $this->Form->create($resForm); ?>
					<?= $this->Form->input('email'); ?>
					<?= $this->Form->input('scoutgroup', ['options' => $scoutgroups, 'class' => 'hierarchy-select']); ?>
					<?= $this->Form->button('Request Password Reset') ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>