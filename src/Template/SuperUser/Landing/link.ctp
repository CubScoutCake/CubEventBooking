<div class="row">
    <div class="col-lg-12">
        <?php   echo $this->cell('FullLink'); ?>
        <div class="panel-group" id="accordion">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-info">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Search Users</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php echo $this->Form->create(); ?>
                                    <div class="table-responsive">
                                        <table class="table  table-condensed">
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <?php echo $this->Form->input('section_id', ['options' => $sections, 'empty' => true]); ?>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <?php echo $this->Form->input('role_id', ['options' => $roles, 'empty' => true]); ?>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <?php echo $this->Form->input('auth_role_id', ['options' => $authRoles, 'empty' => true]); ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <br/>
                                                            <?php echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']); ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                            <?php if (!empty($users)) : ?>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br/>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <th><?= $this->Paginator->sort('full_name') ?></th>
                                                        <th class="actions"><?= __('Actions') ?></th>
                                                        <th><?= $this->Paginator->sort('section_id', 'Section') ?></th>
                                                        <th><?= $this->Paginator->sort('role_id', 'Role') ?></th>
                                                        <th><?= $this->Paginator->sort('modified', 'Date Modified') ?></th>
                                                        <th><?= $this->Paginator->sort('auth_role_id', 'Access Level') ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($users as $user): ?>
                                                        <tr>
                                                            <td><?= $this->Text->truncate($user->full_name,38) ?></td>
                                                            <td class="actions">
                                                                <a href="<?php echo $this->Url->build([
                                                                    'controller' => 'Users',
                                                                    'action' => 'view',
                                                                    $user->id
                                                                ]); ?>">
                                                                    <div class="btn">
                                                                        <button type="button" class="btn btn-primary btn-sm">
                                                                            <i class="fa fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td><?= $user->has('section') ? $this->Text->truncate($user->section->section,18) : '' ?></td>
                                                            <td><?= $user->has('role') ? $this->Text->truncate($user->role->role,18) : '' ?></td>
                                                            <td><?= $this->Time->i18nFormat($user->modified, 'dd-MMM-yy HH:mm') ?></td>
                                                            <td><?= $user->has('auth_role') ? $user->auth_role->auth_role : '' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-info">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-paw fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Search Scout Groups</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php echo $this->Form->create(); ?>
                                    <div class="table-responsive">
                                        <table class="table  table-condensed">
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <?php echo $this->Form->input('district_id', ['options' => $districts, 'empty' => true]); ?>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <br/>
                                                            <?php echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']); ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                            <?php if (!empty($scoutgroups)) : ?>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br/>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th><?= __('id') ?></th>
                                                        <th><?= __('Scout Group') ?></th>
                                                        <th><?= __('Actions') ?></th>
                                                        <th><?= __('District') ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($scoutgroups as $scoutgroup): ?>
                                                        <tr>
                                                            <td><?= $this->Number->format($scoutgroup->id) ?></td>
                                                            <td><?= h($scoutgroup->scoutgroup) ?></td>
                                                            <td class="actions">
                                                                <?= $this->Html->link('', ['controller' => 'Scoutgroups', 'action' => 'view', $scoutgroup->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                                                            </td>
                                                            <td><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>