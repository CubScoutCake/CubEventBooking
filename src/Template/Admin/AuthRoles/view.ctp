<div class="authRoles view large-9 medium-8 columns content">
    <h3><?= h($authRole->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($authRole->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Auth Role') ?></th>
            <td><?= $this->Number->format($authRole->auth_role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Access') ?></th>
            <td><?= $this->Number->format($authRole->admin_access) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Champion Access') ?></th>
            <td><?= $this->Number->format($authRole->champion_access) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Super User') ?></th>
            <td><?= $this->Number->format($authRole->super_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Auth Value') ?></th>
            <td><?= $this->Number->format($authRole->auth_value) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($authRole->users)): ?>
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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($authRole->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->firstname) ?></td>
                <td><?= h($users->lastname) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->last_login) ?></td>
                <td><?= h($users->logins) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
