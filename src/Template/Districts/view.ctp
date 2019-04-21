<?php
/**
* @var \App\Model\Entity\District $district
 */
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <h1 class="page-header"><i class="fal fa-sitemap fa-fw"></i> <?= h($district->district); ?></h1>
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
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
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