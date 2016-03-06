<h3><?= __('Actions') ?></h3>
<ul class="side-nav">
	<li><?= $this->Html->link(__('Index'), ['action' => 'index']) ?></li>
	<li><?= $this->Html->link(__('Update Invoice'), ['controller' => 'Invoices', 'action' => 'regenerate',$invoice->id]) ?></li>
</ul>