<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="roles view large-10 medium-9 columns">
    <h2><?= h($role->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($role->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($role->id) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Invested') ?></h6>
            <p><?= $role->invested ? __('Yes') : __('No'); ?></p>
            <h6 class="subheader"><?= __('Minor') ?></h6>
            <p><?= $role->minor ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Attendees') ?></h4>
    <?php if (!empty($role->attendees)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Scoutgroup Id') ?></th>
            <th><?= __('Role Id') ?></th>
            <th><?= __('Firstname') ?></th>
            <th><?= __('Lastname') ?></th>
            <th><?= __('Dateofbirth') ?></th>
            <th><?= __('Phone') ?></th>
            <th><?= __('Phone2') ?></th>
            <th><?= __('Address 1') ?></th>
            <th><?= __('Address 2') ?></th>
            <th><?= __('City') ?></th>
            <th><?= __('County') ?></th>
            <th><?= __('Postcode') ?></th>
            <th><?= __('Nightsawaypermit') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($role->attendees as $attendees): ?>
        <tr>
            <td><?= h($attendees->id) ?></td>
            <td><?= h($attendees->user_id) ?></td>
            <td><?= h($attendees->scoutgroup_id) ?></td>
            <td><?= h($attendees->role_id) ?></td>
            <td><?= h($attendees->firstname) ?></td>
            <td><?= h($attendees->lastname) ?></td>
            <td><?= h($attendees->dateofbirth) ?></td>
            <td><?= h($attendees->phone) ?></td>
            <td><?= h($attendees->phone2) ?></td>
            <td><?= h($attendees->address_1) ?></td>
            <td><?= h($attendees->address_2) ?></td>
            <td><?= h($attendees->city) ?></td>
            <td><?= h($attendees->county) ?></td>
            <td><?= h($attendees->postcode) ?></td>
            <td><?= h($attendees->nightsawaypermit) ?></td>
            <td><?= h($attendees->created) ?></td>
            <td><?= h($attendees->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendees', 'action' => 'delete', $attendees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendees->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Users') ?></h4>
    <?php if (!empty($role->users)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Role Id') ?></th>
            <th><?= __('Scoutgroup Id') ?></th>
            <th><?= __('Admin') ?></th>
            <th><?= __('Firstname') ?></th>
            <th><?= __('Lastname') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Password') ?></th>
            <th><?= __('Phone') ?></th>
            <th><?= __('Address 1') ?></th>
            <th><?= __('Address 2') ?></th>
            <th><?= __('City') ?></th>
            <th><?= __('County') ?></th>
            <th><?= __('Postcode') ?></th>
            <th><?= __('Section') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($role->users as $users): ?>
        <tr>
            <td><?= h($users->id) ?></td>
            <td><?= h($users->role_id) ?></td>
            <td><?= h($users->scoutgroup_id) ?></td>
            <td><?= h($users->admin) ?></td>
            <td><?= h($users->firstname) ?></td>
            <td><?= h($users->lastname) ?></td>
            <td><?= h($users->email) ?></td>
            <td><?= h($users->password) ?></td>
            <td><?= h($users->phone) ?></td>
            <td><?= h($users->address_1) ?></td>
            <td><?= h($users->address_2) ?></td>
            <td><?= h($users->city) ?></td>
            <td><?= h($users->county) ?></td>
            <td><?= h($users->postcode) ?></td>
            <td><?= h($users->section) ?></td>
            <td><?= h($users->created) ?></td>
            <td><?= h($users->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
