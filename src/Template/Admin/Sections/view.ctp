<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Section'), ['action' => 'edit', $section->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Section'), ['action' => 'delete', $section->id], ['confirm' => __('Are you sure you want to delete # {0}?', $section->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Section Types'), ['controller' => 'SectionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section Type'), ['controller' => 'SectionTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scoutgroups'), ['controller' => 'Scoutgroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scoutgroup'), ['controller' => 'Scoutgroups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sections view large-9 medium-8 columns content">
    <h3><?= h($section->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Section') ?></th>
            <td><?= h($section->section) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Section Type') ?></th>
            <td><?= $section->has('section_type') ? $this->Html->link($section->section_type->id, ['controller' => 'SectionTypes', 'action' => 'view', $section->section_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scoutgroup') ?></th>
            <td><?= $section->has('scoutgroup') ? $this->Html->link($section->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $section->scoutgroup->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($section->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($section->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($section->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($section->deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Applications') ?></h4>
        <?php if (!empty($section->applications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Scoutgroup Id') ?></th>
                <th scope="col"><?= __('Section') ?></th>
                <th scope="col"><?= __('Permitholder') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modification') ?></th>
                <th scope="col"><?= __('Eventname') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Osm Event Id') ?></th>
                <th scope="col"><?= __('Cc Att Total') ?></th>
                <th scope="col"><?= __('Cc Att Cubs') ?></th>
                <th scope="col"><?= __('Cc Att Yls') ?></th>
                <th scope="col"><?= __('Cc Att Leaders') ?></th>
                <th scope="col"><?= __('Cc Inv Count') ?></th>
                <th scope="col"><?= __('Cc Inv Total') ?></th>
                <th scope="col"><?= __('Cc Inv Cubs') ?></th>
                <th scope="col"><?= __('Cc Inv Yls') ?></th>
                <th scope="col"><?= __('Cc Inv Leaders') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($section->applications as $applications): ?>
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
                <td><?= h($applications->event_id) ?></td>
                <td><?= h($applications->osm_event_id) ?></td>
                <td><?= h($applications->cc_att_total) ?></td>
                <td><?= h($applications->cc_att_cubs) ?></td>
                <td><?= h($applications->cc_att_yls) ?></td>
                <td><?= h($applications->cc_att_leaders) ?></td>
                <td><?= h($applications->cc_inv_count) ?></td>
                <td><?= h($applications->cc_inv_total) ?></td>
                <td><?= h($applications->cc_inv_cubs) ?></td>
                <td><?= h($applications->cc_inv_yls) ?></td>
                <td><?= h($applications->cc_inv_leaders) ?></td>
                <td><?= h($applications->deleted) ?></td>
                <td><?= h($applications->section_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Attendees') ?></h4>
        <?php if (!empty($section->attendees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Scoutgroup Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Dateofbirth') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Phone2') ?></th>
                <th scope="col"><?= __('Address 1') ?></th>
                <th scope="col"><?= __('Address 2') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('County') ?></th>
                <th scope="col"><?= __('Postcode') ?></th>
                <th scope="col"><?= __('Nightsawaypermit') ?></th>
                <th scope="col"><?= __('Vegetarian') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Osm Generated') ?></th>
                <th scope="col"><?= __('Osm Id') ?></th>
                <th scope="col"><?= __('Osm Sync Date') ?></th>
                <th scope="col"><?= __('User Attendee') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($section->attendees as $attendees): ?>
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
                <td><?= h($attendees->vegetarian) ?></td>
                <td><?= h($attendees->created) ?></td>
                <td><?= h($attendees->modified) ?></td>
                <td><?= h($attendees->osm_generated) ?></td>
                <td><?= h($attendees->osm_id) ?></td>
                <td><?= h($attendees->osm_sync_date) ?></td>
                <td><?= h($attendees->user_attendee) ?></td>
                <td><?= h($attendees->deleted) ?></td>
                <td><?= h($attendees->section_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($section->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Scoutgroup Id') ?></th>
                <th scope="col"><?= __('Authrole') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Address 1') ?></th>
                <th scope="col"><?= __('Address 2') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('County') ?></th>
                <th scope="col"><?= __('Postcode') ?></th>
                <th scope="col"><?= __('Section') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Osm User Id') ?></th>
                <th scope="col"><?= __('Osm Secret') ?></th>
                <th scope="col"><?= __('Osm Section Id') ?></th>
                <th scope="col"><?= __('Osm Linked') ?></th>
                <th scope="col"><?= __('Osm Linkdate') ?></th>
                <th scope="col"><?= __('Osm Current Term') ?></th>
                <th scope="col"><?= __('Osm Term End') ?></th>
                <th scope="col"><?= __('Pw Reset') ?></th>
                <th scope="col"><?= __('Last Login') ?></th>
                <th scope="col"><?= __('Logins') ?></th>
                <th scope="col"><?= __('Validated') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Digest Hash') ?></th>
                <th scope="col"><?= __('Pw Salt') ?></th>
                <th scope="col"><?= __('Api Key Plain') ?></th>
                <th scope="col"><?= __('Api Key') ?></th>
                <th scope="col"><?= __('Auth Role Id') ?></th>
                <th scope="col"><?= __('Pw State') ?></th>
                <th scope="col"><?= __('Membership Number') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($section->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->role_id) ?></td>
                <td><?= h($users->scoutgroup_id) ?></td>
                <td><?= h($users->authrole) ?></td>
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
                <td><?= h($users->username) ?></td>
                <td><?= h($users->osm_user_id) ?></td>
                <td><?= h($users->osm_secret) ?></td>
                <td><?= h($users->osm_section_id) ?></td>
                <td><?= h($users->osm_linked) ?></td>
                <td><?= h($users->osm_linkdate) ?></td>
                <td><?= h($users->osm_current_term) ?></td>
                <td><?= h($users->osm_term_end) ?></td>
                <td><?= h($users->pw_reset) ?></td>
                <td><?= h($users->last_login) ?></td>
                <td><?= h($users->logins) ?></td>
                <td><?= h($users->validated) ?></td>
                <td><?= h($users->deleted) ?></td>
                <td><?= h($users->digest_hash) ?></td>
                <td><?= h($users->pw_salt) ?></td>
                <td><?= h($users->api_key_plain) ?></td>
                <td><?= h($users->api_key) ?></td>
                <td><?= h($users->auth_role_id) ?></td>
                <td><?= h($users->pw_state) ?></td>
                <td><?= h($users->membership_number) ?></td>
                <td><?= h($users->section_id) ?></td>
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
