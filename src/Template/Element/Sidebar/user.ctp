<h3><?= __('Navigation') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->image('icons/HomeSmall.png', ['alt' => 'User Home', 'url' => ['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]]) ?></li>
	<li><?= $this->Html->link(__('Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?></li>
</ul>
