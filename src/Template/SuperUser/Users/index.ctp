<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-user fa-fw"></i> All Users</h3>
        <?php echo $this->Form->create(); ?>
            <div class="table-responsive">
                <table class="table  table-condensed">
                    <tr>
                        <td>
                            <br/>
                            <div class="row">
                                <div class="col-lg-10">
                                    <?php echo $this->Form->input('q', ['label' => false, 'placeholder' => 'Search...']); ?>
                                </div>
                                <div class="col-lg-1">
                                    <?php echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-primary']); ?>
                                </div>
                                <div class="col-lg-1">
                                    <?php echo $this->Form->button('Reset', ['action' => 'index', 'class' => 'btn btn-warning']); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('section_id', ['options' => $sections, 'empty' => true]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('role_id', ['options' => $roles, 'empty' => true]); ?>
                                </div>
                                <div class="col-lg-4">
                                    <?php echo $this->Form->input('auth_role_id', ['options' => $authRoles, 'empty' => true]); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        <?php echo $this->Form->end(); ?>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('full_name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('section_id', 'Section') ?></th>
                        <th><?= $this->Paginator->sort('role_id', 'Role') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <th><?= $this->Paginator->sort('last_login') ?></th>
                        <th><?= $this->Paginator->sort('auth_role_id', 'Access Level') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Text->truncate($user->full_name,38) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?></li>
                                        <li><?= $this->Html->link(__('Update'), ['action' => 'update', $user->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
                                        <li class="divider"></li>
                                        <li><?= $this->Html->link(__('New App'), ['controller' => 'Applications', 'action' => 'add', $user->id]) ?></li>
                                        <li><?= $this->Html->link(__('New Inv'), ['controller' => 'Invoices', 'action' => 'add', $user->id]) ?></li>
                                        <li><?= $this->Html->link(__('New Att'), ['controller' => 'Attendees', 'action' => 'add', $user->id]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= $user->has('section') ? $this->Html->link($this->Text->truncate($user->section->section,18), ['controller' => 'Sections', 'action' => 'view', $user->section->id]) : '' ?></td>
                            <td><?= $user->has('role') ? $this->Html->link($this->Text->truncate($user->role->role,32), ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                            <td><?= $this->Text->autoLinkEmails($user->email) ?></td>
                            <td><?= $user->has('last_login') ? $this->Time->i18nFormat($user->last_login, 'dd-MMM-yy HH:mm') : '' ?></td>
                            <td><?= $user->has('auth_role') ? $this->Html->link($user->auth_role->auth_role, ['controller' => 'AuthRoles', 'action' => 'view', $user->auth_role->id]) : '' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    </div>
</div>
