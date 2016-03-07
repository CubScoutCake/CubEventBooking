<h3><?= __('Navigation') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Start Page'), ['controller' => 'Landing', 'action' => 'welcome', 'prefix' => false]) ?></li>
	<li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login', 'prefix' => false, $eventId]) ?></li>
	<li><?= $this->Html->link(__('Register'), ['controller' => 'Users','action' => 'register', 'prefix' => 'register', $eventId]) ?></li>
	<li><?= $this->Html->link(__('Join Mailing List'), ['controller' => 'Mailchimp','action' => 'mailchimp', 'prefix' => false]) ?></li>
</ul>