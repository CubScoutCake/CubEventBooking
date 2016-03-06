<h3><?= __('Navigation') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Start Page'), ['controller' =>  'Landing', 'action' => 'welcome']) ?></li>
	<li><?= $this->Html->link(__('Register'), ['action' => 'register']) ?></li>
</ul>