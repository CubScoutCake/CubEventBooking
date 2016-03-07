<h3><?= __('Actions') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Index'), ['prefix' => 'champion', 'action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('New'), ['prefix' => 'champion', 'action' => 'add']) ?></li>
	<li><?= $this->Html->link(__('Delete'), ['prefix' => 'champion', 'action' => 'delete']) ?></li>
</ul>