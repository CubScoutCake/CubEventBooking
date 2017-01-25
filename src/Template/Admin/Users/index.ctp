<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-user     fa-fw"></i> All Users</h3>
        <div class="table-responsive">
            <table class="table  table-condensed">
                <tr>
                    <td>
                        <?php echo $this->Form->create();
                            echo $this->Form->input('q', ['label' => 'Search for User']);
                            echo '</td><td>';
                            echo $this->Form->button('Filter', ['type' => 'submit']);
                            echo '</td></tr></table>';
                            echo '<table class="table table-condensed"><tr><td>';
                            // You'll need to populate $authors in the template from your controller
                            echo $this->Form->input('section_id', ['options' => $sections, 'empty' => true]);
                            echo '</td><td>';
                            echo $this->Form->input('role_id', ['options' => $roles, 'empty' => true]);
                            echo '</td><td>';
                            echo $this->Form->input('auth_role_id', ['options' => $authRoles, 'empty' => true]);
                            echo '</td></tr></table></div>';

                            //echo $this->Form->button('Reset', ['action' => 'index']);
                            echo $this->Form->end();
                        ?>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('full_name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('section_id', 'Section') ?></th>
                        <th><?= $this->Paginator->sort('role_id', 'Role') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <th><?= $this->Paginator->sort('modified', 'Date Modified') ?></th>
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
                            <td><?= $this->Time->i18nFormat($user->modified, 'dd-MMM-yy HH:mm') ?></td>
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
