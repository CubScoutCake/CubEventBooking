<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Discount'), ['action' => 'edit', $discount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Discount'), ['action' => 'delete', $discount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $discount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Discounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discount'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="discounts view large-9 medium-8 columns content">
    <h3><?= h($discount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Discount') ?></th>
            <td><?= h($discount->discount) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($discount->code) ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($discount->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($discount->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Discount Value') ?></th>
            <td><?= $this->Number->format($discount->discount_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Discount Number') ?></th>
            <td><?= $this->Number->format($discount->discount_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Active') ?></th>
            <td><?= $discount->active ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Events') ?></h4>
        <?php if (!empty($discount->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Full Name') ?></th>
                <th><?= __('Start') ?></th>
                <th><?= __('End') ?></th>
                <th><?= __('Location') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deposit') ?></th>
                <th><?= __('Deposit Date') ?></th>
                <th><?= __('Deposit Value') ?></th>
                <th><?= __('Deposit Inc Leaders') ?></th>
                <th><?= __('Deposit Text') ?></th>
                <th><?= __('Cubs') ?></th>
                <th><?= __('Cubs Value') ?></th>
                <th><?= __('Cubs Text') ?></th>
                <th><?= __('Yls') ?></th>
                <th><?= __('Yls Value') ?></th>
                <th><?= __('Yls Text') ?></th>
                <th><?= __('Leaders') ?></th>
                <th><?= __('Leaders Value') ?></th>
                <th><?= __('Leaders Text') ?></th>
                <th><?= __('Logo') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('City') ?></th>
                <th><?= __('County') ?></th>
                <th><?= __('Postcode') ?></th>
                <th><?= __('Invtext Id') ?></th>
                <th><?= __('Legaltext Id') ?></th>
                <th><?= __('Discount Id') ?></th>
                <th><?= __('Intro Text') ?></th>
                <th><?= __('Tagline Text') ?></th>
                <th><?= __('Live') ?></th>
                <th><?= __('Max') ?></th>
                <th><?= __('Max Cubs') ?></th>
                <th><?= __('Max Yls') ?></th>
                <th><?= __('Max Leaders') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($discount->events as $events): ?>
            <tr>
                <td><?= h($events->id) ?></td>
                <td><?= h($events->name) ?></td>
                <td><?= h($events->full_name) ?></td>
                <td><?= h($events->start) ?></td>
                <td><?= h($events->end) ?></td>
                <td><?= h($events->location) ?></td>
                <td><?= h($events->created) ?></td>
                <td><?= h($events->modified) ?></td>
                <td><?= h($events->deposit) ?></td>
                <td><?= h($events->deposit_date) ?></td>
                <td><?= h($events->deposit_value) ?></td>
                <td><?= h($events->deposit_inc_leaders) ?></td>
                <td><?= h($events->deposit_text) ?></td>
                <td><?= h($events->cubs) ?></td>
                <td><?= h($events->cubs_value) ?></td>
                <td><?= h($events->cubs_text) ?></td>
                <td><?= h($events->yls) ?></td>
                <td><?= h($events->yls_value) ?></td>
                <td><?= h($events->yls_text) ?></td>
                <td><?= h($events->leaders) ?></td>
                <td><?= h($events->leaders_value) ?></td>
                <td><?= h($events->leaders_text) ?></td>
                <td><?= h($events->logo) ?></td>
                <td><?= h($events->address) ?></td>
                <td><?= h($events->city) ?></td>
                <td><?= h($events->county) ?></td>
                <td><?= h($events->postcode) ?></td>
                <td><?= h($events->invtext_id) ?></td>
                <td><?= h($events->legaltext_id) ?></td>
                <td><?= h($events->discount_id) ?></td>
                <td><?= h($events->intro_text) ?></td>
                <td><?= h($events->tagline_text) ?></td>
                <td><?= h($events->live) ?></td>
                <td><?= h($events->max) ?></td>
                <td><?= h($events->max_cubs) ?></td>
                <td><?= h($events->max_yls) ?></td>
                <td><?= h($events->max_leaders) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
