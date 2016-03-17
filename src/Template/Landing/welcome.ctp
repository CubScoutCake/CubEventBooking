<?= $this->assign('title', 'Hertfordshire Cubs Booking System'); ?>
</br>
</br>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <div class="panel panel-green">
            <div class="panel-heading">
                <h1>Welcome to the Herts Cubs Booking System</h1>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<p>This site has been designed for Leaders to book their group onto County Events including the Hertfordshire Cubs 100th Birthday Camp</p>
				<h3>First Step</h3>
				<p>The first step to begin registering an application is to <strong><?= $this->Html->link(__('register'), ['controller' => 'Users', 'action' => 'register', 'prefix' => 'register', $eventId],['class' => 'button']) ?></strong>.</p>
			</div>
			<div class="panel-footer">
				<h4>Useful Links</h4>
				<ul>
					<li><?= $this->Html->link(__('Herts Cubs Information'), 'http://hertscubs.uk/', ['target' => '__blank']) ?></li>
					<li><?= $this->Html->link(__('Register for this booking System'), ['controller' => 'Users', 'action' => 'register', 'prefix' => 'register', $eventId]) ?></li>
					<li><?= $this->Html->link(__('Sign Up for the Mailing List'), ['controller' => 'Mailchimp', 'action' => 'mailchimp', 'prefix' => false]) ?></li>
					<li><?= $this->Html->link(__('Promotional Site Home'), 'http://hertscubs100.uk/', ['target' => '__blank']) ?></li>
					<li><?= $this->Html->link(__('Hertfordshire Scouts'), 'http://hertfordshirescouts.org.uk/', ['target' => '__blank']) ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>