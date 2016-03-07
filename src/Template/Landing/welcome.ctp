<?= $this->assign('title', 'Hertfordshire Cubs Booking System'); ?>

<div class="landing actions columns large-2 medium-3">

	<?= $this->start('Sidebar');
	echo $this->element('Sidebar/outside');
	$this->end(); ?>
	
	<?= $this->fetch('Sidebar') ?>
	
</div>

<div class="landing user_home large-10 medium-9 columns content">
	<div>
		</br>
		<p>This site has been designed for Leaders to book their group onto County Events including the Hertfordshire Cubs 100th Birthday Camp</p>
		<h3>First Step</h3>
		<p>The first step to begin registering an application is to <?= $this->Html->link(__('register'), ['controller' => 'Users', 'action' => 'register', 'prefix' => 'register', $eventId]) ?>.<p>

		<h4>Useful Links</h4>
		<ul>
			<li><?= $this->Html->link(__('Register for this booking System'), ['controller' => 'Users', 'action' => 'register', 'prefix' => 'register', $eventId]) ?></li>
			<li><?= $this->Html->link(__('Sign Up for the Mailing List'), ['controller' => 'Mailchimp', 'action' => 'mailchimp', 'prefix' => false]) ?></li>
			<li><?= $this->Html->link(__('Promotional Site Home'), 'http://hertscubs100.uk/', ['target' => '__blank']) ?></li>
			<li><?= $this->Html->link(__('Hertfordshire Scouts'), 'http://hertfordshirescouts.org.uk/', ['target' => '__blank']) ?></li>
		</ul>
	</div>
</div>
