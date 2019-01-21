<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-id-card fa-fw"></i> Authorisation Roles</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('auth_role') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('admin_access') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('champion_access') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('super_user') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('auth_value') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($authRoles as $authRole): ?>
                    <tr>
                        <td><?= $this->Number->format($authRole->id) ?></td>
                        <td><?= h($authRole->auth_role) ?></td>
                        <td><?= $authRole->admin_access ? __('Admin') : __('No Access'); ?></td>
                        <td><?= $authRole->champion_access ? __('Champion') : __('No Access'); ?></td>
                        <td><?= $authRole->super_user ? __('Super User') : __('No Access'); ?></td>
                        <td><?= $this->Number->format($authRole->auth_value) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $authRole->id]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
