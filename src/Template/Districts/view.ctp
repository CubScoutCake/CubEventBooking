<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fa fa-sitemap fa-fw"></i> <?= h($district->district); ?></h1>
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
                <i class="fa fa-key fa-fw"></i> District Info
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
                <i class="fa fa-level-down fa-fw"></i> Related Items
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <?php if (!empty($district->champions)): ?>
                    <li class="active">
                        <a href="#champ-pills" data-toggle="tab"><i class="fa fa-life-ring fa-fw"></i> Champions</a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($district->scoutgroups)): ?>
                        <li><a href="#grp-pills" data-toggle="tab"><i class="fa fa-paw fa-fw"></i> Scout Groups</a></li>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($district->champions as $champions): ?>
                                            <tr>
                                                <td><?= h($champions->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Champions', 'action' => 'view', $champions->id]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= h($champions->full_name) ?></td>
                                                <td><?= $this->Text->autolink($champions->email) ?></td>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($district->scoutgroups as $scoutgroups): ?>
                                            <tr>
                                                <td><?= h($scoutgroups->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Scoutgroups', 'action' => 'view', $scoutgroups->id]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= h($scoutgroups->scoutgroup) ?></td>
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