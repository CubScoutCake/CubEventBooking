<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fal fa-sitemap fa-fw"></i> <?= h($district->district); ?></h1>
    </div>
    <div class="col-lg-2 col-md-2">
        </br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Districts',
                        'action' => 'edit',
                        'prefix' => 'admin',
                        $district->id],['_full']); ?>">Edit District</a>
                    </li>
                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $district->id], ['confirm' => __('Are you sure you want to delete # {0}?', $district->id)]) ?></li>
                </ul>
            </div>
        </div>
        </br>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fal fa-key fa-fw"></i> District Info
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <h5 class="subheader"><?= __('District') ?></h5>
                <p><?= h($district->district) ?></p>
                <h5 class="subheader"><?= __('County') ?></h5>
                <p><?= h($district->county) ?></p>             
            </div>
            <div class="panel-footer">          
                <h5 class="subheader"><?= __('Id') ?></h5>
                <p><?= $this->Number->format($district->id) ?></p>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($district->scoutgroups) || !empty($district->champions)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fal fa-level-down fa-fw"></i> Related Items
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <?php if (!empty($district->champions)): ?>
                    <li class="active">
                        <a href="#champ-pills" data-toggle="tab"><i class="fal fa-life-ring fa-fw"></i> Champions</a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($district->scoutgroups)): ?>
                        <li><a href="#grp-pills" data-toggle="tab"><i class="fal fa-paw fa-fw"></i> Scout Groups</a></li>
                    <?php endif; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php if (!empty($district->champions)): ?>
                        <div class="tab-pane fade in fade-in active" id="champ-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Full Name') ?></th>
                                            <th><?= __('Email') ?></th>
                                            <th><?= __('User Account') ?></th>
                                            <th><?= __('Last Login') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($district->champions as $champions): ?>
                                            <tr>
                                                <td><?= h($champions->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Champions', 'action' => 'view', $champions->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['controller' => 'Champions', 'action' => 'edit', $champions->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Champions', 'action' => 'delete', $champions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champions->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= h($champions->full_name) ?></td>
                                                <td><?= $this->Text->autolink($champions->email) ?></td>
                                                <td><?= $champions->has('user') ? $this->Html->link($this->Text->truncate($champions->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $champions->user->id]) : '' ?></td>
                                                <td><?= $champions->has('user') ? $this->Time->i18nFormat($champions->user->last_login,'dd-MMM-YY HH:mm', 'Europe/London') : '' ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($district->scoutgroups)): ?>
                        <div class="tab-pane fade" id="grp-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Scout Group') ?></th>
                                            <th><?= __('') ?></th>
                                            <th><?= __('') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($district->scoutgroups as $scoutgroups): ?>
                                            <tr class="info">
                                                <td><?= h($scoutgroups->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Scoutgroups', 'action' => 'view', $scoutgroups->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['controller' => 'Scoutgroups', 'action' => 'edit', $scoutgroups->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Scoutgroups', 'action' => 'delete', $scoutgroups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroups->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= h($scoutgroups->scoutgroup) ?></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php if (!empty($scoutgroups->applications)): ?>
                                                <thead>
                                                    <tr>
                                                        <th><?= __('') ?></th>
                                                        <th><?= __('App') ?></th>
                                                        <th class="actions"><?= __('Actions') ?></th>
                                                        <th><?= __('User') ?></th>
                                                        <th><?= __('Event') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($scoutgroups->applications as $applications): ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= h($applications->display_code) ?></td>
                                                            <td class="actions">
                                                                <div class="dropdown btn-group">
                                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu " role="menu">
                                                                        <li><?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?></li>
                                                                        <li><?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?></li>
                                                                        <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td><?= $applications->has('user') ? $this->Html->link($this->Text->truncate($applications->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $applications->user->id]) : '' ?></td>
                                                            <td><?= $applications->has('event') ? $this->Html->link($this->Text->truncate($applications->event->name,18), ['controller' => 'Events', 'action' => 'view', $applications->event->id]) : '' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($scoutgroups->applications)): ?>
                        <div class="tab-pane fade" id="appl-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('User') ?></th>
                                            <th><?= __('Event') ?></th>
                                            <th><?= __('Section') ?></th>
                                            <th><?= __('Permitholder') ?></th>
                                            <th><?= __('Created') ?></th>
                                            <th><?= __('Modified') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($scoutgroups->applications as $applications): ?>
                                            <tr>
                                                <td><?= h($applications->display_code) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $applications->has('user') ? $this->Html->link($this->Text->truncate($applications->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $applications->user->id]) : '' ?></td>
                                                <td><?= $applications->has('event') ? $this->Html->link($this->Text->truncate($applications->event->name,18), ['controller' => 'Events', 'action' => 'view', $applications->event->id]) : '' ?></td>
                                                <td><?= h($applications->section) ?></td>
                                                <td><?= h($applications->permitholder) ?></td>
                                                <td><?= h($applications->created) ?></td>
                                                <td><?= h($applications->modified) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>