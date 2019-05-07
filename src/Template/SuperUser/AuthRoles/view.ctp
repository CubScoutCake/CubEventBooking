<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuthRole $authRole
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Auth Role'), ['action' => 'edit', $authRole->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Auth Role'), ['action' => 'delete', $authRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $authRole->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Auth Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Auth Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="authRoles view large-9 medium-8 columns content">
    <h3><?= h($authRole->auth_role) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Auth Role') ?></th>
            <td><?= h($authRole->auth_role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($authRole->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Auth') ?></th>
            <td><?= $this->Number->format($authRole->auth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Access') ?></th>
            <td><?= $authRole->admin_access ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Champion Access') ?></th>
            <td><?= $authRole->champion_access ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Super User') ?></th>
            <td><?= $authRole->super_user ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Access') ?></th>
            <td><?= $authRole->parent_access ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Access') ?></th>
            <td><?= $authRole->user_access ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Section Limited') ?></th>
            <td><?= $authRole->section_limited ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($authRole->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
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
                <th scope="col"><?= __('Legacy Section') ?></th>
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
                <th scope="col"><?= __('Password State Id') ?></th>
                <th scope="col"><?= __('Membership Number') ?></th>
                <th scope="col"><?= __('Section Id') ?></th>
                <th scope="col"><?= __('Simple Attendees') ?></th>
                <th scope="col"><?= __('Member Validated') ?></th>
                <th scope="col"><?= __('Section Validated') ?></th>
                <th scope="col"><?= __('Email Validated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($authRole->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->role_id) ?></td>
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
                <td><?= h($users->legacy_section) ?></td>
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
                <td><?= h($users->password_state_id) ?></td>
                <td><?= h($users->membership_number) ?></td>
                <td><?= h($users->section_id) ?></td>
                <td><?= h($users->simple_attendees) ?></td>
                <td><?= h($users->member_validated) ?></td>
                <td><?= h($users->section_validated) ?></td>
                <td><?= h($users->email_validated) ?></td>
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
