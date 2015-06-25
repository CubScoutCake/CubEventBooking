<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Application'), ['action' => 'edit', $application->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Application'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="applications view large-10 medium-9 columns">
    <h2><?= h($application->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $application->has('user') ? $this->Html->link($application->user->id, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Section') ?></h6>
            <p><?= h($application->section) ?></p>
            <h6 class="subheader"><?= __('Eventname') ?></h6>
            <p><?= h($application->eventname) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($application->id) ?></p>
            <h6 class="subheader"><?= __('Scoutgroup Id') ?></h6>
            <p><?= $this->Number->format($application->scoutgroup_id) ?></p>
            <h6 class="subheader"><?= __('Permitholder') ?></h6>
            <p><?= $this->Number->format($application->permitholder) ?></p>
            <h6 class="subheader"><?= __('Modification') ?></h6>
            <p><?= $this->Number->format($application->modification) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($application->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($application->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Attendees') ?></h4>
    <?php if (!empty($application->attendees)): ?>
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
        <?php foreach ($application->attendees as $attendees): ?>
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
