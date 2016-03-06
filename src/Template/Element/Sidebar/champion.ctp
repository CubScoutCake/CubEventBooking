<h3><?= __('Navigation') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Champion Home'), ['prefix' => 'champion', 'controller' => 'Landing', 'action' => 'champion_home']) ?></li>
	<li><?= $this->Html->link(__('User Home'), ['prefix' => false, 'controller' => 'Landing', 'action' => 'user_home']) ?></li>
</ul>

<h3><?= __('Champ Nav') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Users'), ['prefix' => 'champion', 'controller' => 'Users', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Roles'), ['prefix' => 'champion', 'controller' => 'Roles', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Applications'), ['prefix' => 'champion', 'controller' => 'Applications', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Attendees'), ['prefix' => 'champion', 'controller' => 'Attendees', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Allergies'), ['prefix' => 'champion', 'controller' => 'Allergies', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Invoices'), ['prefix' => 'champion', 'controller' => 'Invoices', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Payments'), ['prefix' => 'champion', 'controller' => 'Payments', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Champions'), ['prefix' => 'champion', 'controller' => 'Champions', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Districts'), ['prefix' => 'champion', 'controller' => 'Districts', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Scout Groups'), ['prefix' => 'champion', 'controller' => 'Scoutgroups', 'action' => 'index']) ?></li>
</ul>
