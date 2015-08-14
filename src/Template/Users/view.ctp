<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scoutgroups'), ['controller' => 'Scoutgroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scoutgroup'), ['controller' => 'Scoutgroups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="users view large-10 medium-9 columns">
    <h2><?= h($user->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= $user->has('role') ? $this->Html->link($user->role->id, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Scoutgroup') ?></h6>
            <p><?= $user->has('scoutgroup') ? $this->Html->link($user->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $user->scoutgroup->scoutgroup]) : '' ?></p>
            <h6 class="subheader"><?= __('Firstname') ?></h6>
            <p><?= h($user->firstname) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($user->lastname) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($user->email) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($user->password) ?></p>
            <h6 class="subheader"><?= __('Phone') ?></h6>
            <p><?= h($user->phone) ?></p>
            <h6 class="subheader"><?= __('Address 1') ?></h6>
            <p><?= h($user->address_1) ?></p>
            <h6 class="subheader"><?= __('Address 2') ?></h6>
            <p><?= h($user->address_2) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($user->city) ?></p>
            <h6 class="subheader"><?= __('County') ?></h6>
            <p><?= h($user->county) ?></p>
            <h6 class="subheader"><?= __('Postcode') ?></h6>
            <p><?= h($user->postcode) ?></p>
            <!--<h6 class="subheader"><?= __('Section') ?></h6>
            <p><?= h($user->section) ?></p>-->
            <h6 class="subheader"><?= __('Username') ?></h6>
            <p><?= h($user->username) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($user->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($user->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Admin') ?></h6>
            <p><?= $user->admin ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Applications') ?></h4>
    <?php if (!empty($user->applications)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Scoutgroup Id') ?></th>
            <th><?= __('Section') ?></th>
            <th><?= __('Permitholder') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Modification') ?></th>
            <th><?= __('Eventname') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->applications as $applications): ?>
        <tr>
            <td><?= h($applications->id) ?></td>
            <td><?= h($applications->user_id) ?></td>
            <td><?= h($applications->scoutgroup_id) ?></td>
            <td><?= h($applications->section) ?></td>
            <td><?= h($applications->permitholder) ?></td>
            <td><?= h($applications->created) ?></td>
            <td><?= h($applications->modified) ?></td>
            <td><?= h($applications->modification) ?></td>
            <td><?= h($applications->eventname) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Attendees') ?></h4>
    <?php if (!empty($user->attendees)): ?>
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
        <?php foreach ($user->attendees as $attendees): ?>
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
