<h3><?= __('Navigation') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Admin Home'), ['prefix' => 'admin', 'controller' => 'Landing', 'action' => 'admin_home']) ?></li>
	<li><?= $this->Html->link(__('Champion Home'), ['prefix' => 'champion', 'controller' => 'Landing', 'action' => 'champion_home']) ?></li>
	<li><?= $this->Html->link(__('User Home'), ['prefix' => false, 'controller' => 'Landing', 'action' => 'user_home']) ?></li>
</ul>

<h3><?= __('Admin Nav') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Events'), ['prefix' => 'admin', 'controller' => 'Events', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Users'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Applications'), ['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Attendees'), ['prefix' => 'admin', 'controller' => 'Attendees', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Invoices'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Payments'), ['prefix' => 'admin', 'controller' => 'Payments', 'action' => 'index']) ?></li>
</ul>
