<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_view');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="attendees view large-10 medium-9 columns">
    <h2><?= h($attendee->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $attendee->has('user') ? $this->Html->link($attendee->user->id, ['controller' => 'Users', 'action' => 'view', $attendee->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Firstname') ?></h6>
            <p><?= h($attendee->firstname) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($attendee->lastname) ?></p>
            <h6 class="subheader"><?= __('Phone') ?></h6>
            <p><?= h($attendee->phone) ?></p>
            <h6 class="subheader"><?= __('Phone2') ?></h6>
            <p><?= h($attendee->phone2) ?></p>
            <h6 class="subheader"><?= __('Address 1') ?></h6>
            <p><?= h($attendee->address_1) ?></p>
            <h6 class="subheader"><?= __('Address 2') ?></h6>
            <p><?= h($attendee->address_2) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($attendee->city) ?></p>
            <h6 class="subheader"><?= __('County') ?></h6>
            <p><?= h($attendee->county) ?></p>
            <h6 class="subheader"><?= __('Postcode') ?></h6>
            <p><?= h($attendee->postcode) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($attendee->id) ?></p>
            <h6 class="subheader"><?= __('Scoutgroup Id') ?></h6>
            <p><?= $this->Number->format($attendee->scoutgroup_id) ?></p>
            <h6 class="subheader"><?= __('Role Id') ?></h6>
            <p><?= $this->Number->format($attendee->role_id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Dateofbirth') ?></h6>
            <p><?= h($attendee->dateofbirth) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($attendee->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($attendee->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Nightsawaypermit') ?></h6>
            <p><?= $attendee->nightsawaypermit ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Applications') ?></h4>
    <?php if (!empty($attendee->applications)): ?>
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
        <?php foreach ($attendee->applications as $applications): ?>
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
    <h4 class="subheader"><?= __('Related Allergies') ?></h4>
    <?php if (!empty($attendee->allergies)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Allergy') ?></th>
            <th><?= __('Description') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($attendee->allergies as $allergies): ?>
        <tr>
            <td><?= h($allergies->id) ?></td>
            <td><?= h($allergies->allergy) ?></td>
            <td><?= h($allergies->description) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Allergies', 'action' => 'view', $allergies->allergy]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Allergies', 'action' => 'edit', $allergies->allergy]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Allergies', 'action' => 'delete', $allergies->allergy], ['confirm' => __('Are you sure you want to delete # {0}?', $allergies->allergy)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
